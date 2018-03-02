<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Models\Bunch;
use App\Models\Campaign;
use App\Models\EmailsSent;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign)
    {
        $campaigns = $campaign->orderBy('id', 'asc')->owned()->get();
        return view('campaign.index', compact('campaigns', 'bunch_is_deleted'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Template $template, Bunch $bunch)
    {
        $templates_list = $template->getSelectList();
//        dd();
//        dd($template->get());
        $bunches_list = $bunch->getSelectList('title');
//        dd($bunches_list);
        return view('campaign.create', compact('templates_list', 'bunches_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Campaign $campaign, CampaignRequest $request)
    {
//        dump($request->input('template_id'));
//        dump(Template::all());
//        die();
        $campaign->create($request->all());
        return redirect()->route('campaign.index')->with('message', 'campaign created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $campaigns = $campaign->owned()->findOrFail($campaign->id);
        return view('campaign.show', compact('campaigns'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        $campaigns = $campaign->owned()->findOrFail($campaign->id);
        $templates_list = $campaign->template->getSelectList();
        $bunches_list = $campaign->bunch->getSelectList('title');

        return view('campaign.edit', compact('campaigns', 'templates_list', 'bunches_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $request, Campaign $campaign)
    {
        $campaign->update($request->all());
        return redirect()->route('campaign.index')->with('message', 'successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('campaign.index')->with('message', 'successfully deleted');
    }

    public function comparisonDates ($emailsSent) {
        return Carbon::parse($emailsSent->all()->last()->date)->day <= Carbon::parse($emailsSent->all()->first()->date)->day;
    }

    public function send(Campaign $campaign, EmailsSent $emailsSent)
    {
        if (empty($emailsSent->first())) {
            $emailsSent->create(['amount' => 1, 'date' => Carbon::today()]);
        }
        elseif (empty($emailsSent->all()[1])) {
            $emailsSent->create(['amount' => $emailsSent->all()->last()->amount + 1, 'date' => Carbon::now()]);
        }
        else {
            $amount = $emailsSent->all()->last()->amount;

            if ($amount < 300 && $this->comparisonDates($emailsSent)) {
                $amount = $emailsSent->all()->last()->amount + 1;
                $emailsSent->all()->last()->update(['amount' => $amount, 'date' => Carbon::now()]);
            }
            else {
                return redirect()->route('campaign.index')->with('message', 'sending limit is exhausteds');
            }
        }

        $emails = [];

        foreach ($campaign->bunch->subscribers as $subscriber) {
            $emails[] = $subscriber->email;
            $subs_name = $subscriber->name;
            $subs_surname = $subscriber->surname;
        }

        $content = $campaign->template->content;
        $ready_content = str_replace(['{NAME}', '{SURNAME}'], [$subs_name, $subs_surname], $content);

        Mail::send([], [], function ($message) use ($emails, $ready_content) {
            $message
                ->from('us@example.com', 'Laravel Test Task')
                ->to($emails)
                ->subject('Finish')
                ->setBody($ready_content, 'text/html');
        });


        return redirect()->route('campaign.index', compact('campaign'))->with('message', 'email send');
    }

    public function preview(Campaign $campaign)
    {

        $campaigns = $campaign->owned()->findOrFail($campaign->id);
        return view('campaign.preview', compact('campaigns'));
    }
}
