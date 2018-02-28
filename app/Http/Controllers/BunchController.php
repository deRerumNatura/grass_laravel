<?php

namespace App\Http\Controllers;

use App\Http\Requests\BunchRequest;
use App\Models\Bunch;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class BunchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bunch $bunch)
    {
//        dump($bunch->find(1)->subscribers());
        $bunches = $bunch->owned()->get();
//        $subscr = $bunch::find(1)->subscribers;
//        dump($bunches[0]->subscribers);
        return view('bunch.index', compact('bunches'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Subscriber $subscriber)
    {
//        dd($subscriber->getSelectList());
        $subs_list = $subscriber->getSelectList();

        return view('bunch.create', compact('subs_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Bunch $bunch, BunchRequest $request)
    {
//        dd($request->);
//        $subscriber->set_bunch_id();
        $bunch
            ->create($request->except(['subscriber_ids']))
            ->subscribers()
            ->saveMany(Subscriber::find($request->subscriber_ids));
//        dd();
        return redirect()->route('bunch.index')->with('message', 'bunch created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bunch  $bunch
     * @return \Illuminate\Http\Response
     */
    public function show(Bunch $bunch, Subscriber $subscriber)
    {
        $subs_list = $subscriber->getSelectList();
        $bunches = $bunch->owned()->findOrFail($bunch->id);

        return view('bunch.show', compact('bunches', 'subs_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bunch  $bunch
     * @return \Illuminate\Http\Response
     */
    public function edit(Bunch $bunch, Subscriber $subscriber)
    {
        $subs_list = $subscriber->getSelectList();
        $bunches = $bunch->owned()->findOrFail($bunch->id);

        return view('bunch.edit', compact('bunches', 'subs_list'));
    }


    public function update(BunchRequest $request, Bunch $bunch)
    {

        Subscriber::where('bunch_id', $bunch->id)
            ->whereNotIn('id', $request->subscriber_ids)
            ->update(['bunch_id' => NULL]);

        $bunch
            ->subscribers()
            ->saveMany(Subscriber::find($request->subscriber_ids));

        return redirect()->route('bunch.index')->with('message', 'successfully updated');
    }


    public function destroy(Bunch $bunch)
    {
        $bunch->delete();

        return redirect()->route('bunch.index')->with('message', 'successfully deleted');
    }


}
