<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advertisers;
use App\Locations;
use App\User;

class AdvertisersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisers = Advertisers::with('location')->orderBy('advertiser_id','asc')->paginate(5);
        $locations = Locations::get();
        $users    = User::get();
        return view('advertisers.index' , ['advertisers'=>$advertisers , 'locations'=>$locations, 'users'=>$users]);

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
            'business_name'  => 'required',
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'location_code' => 'required',
            'admin_id' => 'required'
        ]);
        $requestData = $request->all();
        Advertisers::create([
            'business_name'  => $request->business_name,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'location_code' => $request->location_code,
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
            'business_name'  => 'required',
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'location_code' => 'required',
            'admin_id' => 'required'
        ]);
        $requestData = $request->all();
        Advertisers::where('advertiser_id','=',$id)->update([
            'business_name'  => $request->business_name,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'location_code' => $request->location_code,
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
        Advertisers::where('advertiser_id','=',$id)->delete();
        return redirect()->route('advertisers.index')->with('success', 'record delected successfully');
    }
}
