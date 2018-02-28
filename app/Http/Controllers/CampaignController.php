<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Models\Bunch;
use App\Models\Campaign;
use App\Models\Template;
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
        $bunches_list = $bunch->getSelectList('title');
//        dd($bunches_list);
        return view('campaign.create', compact('templates_list', 'bunches_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Campaign $campaign, CampaignRequest $request)
    {
//        dd($request->all());
        $campaign->create($request->all());
        return redirect()->route('campaign.index')->with('message', 'campaign created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
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
     * @param  \App\Campaign  $campaign
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
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
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('campaign.index')->with('message', 'successfully deleted');
    }

    public function send(Campaign $campaign) {

        $emails = [];
//        dd($campaign->bunch);
        foreach ($campaign->bunch->subscribers as $subscriber) {
            $emails[] = $subscriber->email;
        }
//        dd($emails);
        Mail::send([], [], function($message) use ($emails, $campaign)
        {
            $message
                ->from('us@example.com', 'Laravel Test Task')
                ->to($emails)
                ->subject('Main')
                ->setBody($campaign->template->content, 'text/html');
        });

        return redirect()->route('campaign.index', compact('campaign'))->with('message', 'email send');
    }

    public function preview (Campaign $campaign) {
//        dd($campaign->bunch->subscribers->email);
        $campaigns = $campaign->owned()->findOrFail($campaign->id);
        return view('campaign.preview', compact('campaigns'));
    }
}
