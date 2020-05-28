<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advertisers;
use App\User;
use App\Ads;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ads::with('advertiser')->orderBy('id','asc')->paginate(10);
        $advertisers = Advertisers::get();
        $users= User::get();
        return view('ads.index', ['ads'=>$ads, 'advertisers'=>$advertisers, 'users'=>$users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'advertiser_id'  => 'required',
            'ad_image' => 'required',
            'ad_size' => 'required',
            'ad_target' => 'required',
            'ad_action' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'admin_id' => 'required'
        ]);
        $requestData = $request->all();
        Ads::create([
            'advertiser_id'  => $request->advertiser_id,
            'ad_image' => $request->ad_image,
            'ad_size' => $request->ad_size,
            'ad_target' => $request->ad_target,
            'ad_action' => $request->ad_action,
            'startdate' => $request->startdate,
            'enddate' => $request->enddate,
            'admin_id' => $request->admin_id
        ]);
        return redirect()->back()->with('success','Record created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $this->validate($request, [
            'advertiser_id'  => 'required',
            'ad_image' => 'required',
            'ad_size' => 'required',
            'ad_target' => 'required',
            'ad_action' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'admin_id' => 'required'
        ]);
        $requestData = $request->all();
        Ads::find($id)->update([
            'advertiser_id'  => $request->advertiser_id,
            'ad_image' => $request->ad_image,
            'ad_size' => $request->ad_size,
            'ad_target' => $request->ad_target,
            'ad_action' => $request->ad_action,
            'startdate' => $request->startdate,
            'enddate' => $request->enddate,
            'admin_id' => $request->admin_id
        ]);
        return redirect()->back()->with('success','Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ads::find($id)->delete();
        return redirect()->route('ads.index')->with('success', 'record delected successfully');
    }
}
