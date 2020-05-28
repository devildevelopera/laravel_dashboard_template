<?php

namespace App\Http\Controllers;

use App\Stations;
use App\Locations;
use App\User;
use Illuminate\Http\Request;

class StationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stations  = Stations::with('location')->orderBy('id','asc')->paginate(5);
        $locations = Locations::get();
        $users     = User::get();
        return view('stations.index',['stations'=>$stations , 'users'=>$users, 'locations'=>$locations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stations.create');
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
            'station_name'  => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'location_code' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'photo' => 'required',
            'hours' => 'required',
            'created_at' => 'required',
            'admin_id' => 'required'
        ]);
        //$photo =$request->file('photo');
       // $filename = $photo->getClientOriginalName();
        //$fileExtension =$ $photo->getClientOriginalExtension();
        $input = $request->all();
        $photo=array();
        if($files = $request->file('photo')){
            foreach($files as $file){
                $name = $file->getClientOriginalName();
                $file->move('photo', $name);
                $photo[]=$name;
            }
        }
        Stations::create([
            'station_name'  => $request->station_name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'location_code' => $request->location_code,
            'address' => $request->address,
            'phone' => $request->phone,
            'photo' => implode("|", $photo),
            'hours' => $request->hours,
            'created_at' =>$request->created_at,
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
        $station = Stations::find($id);
        return view('stations.edit', compact('station'));
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
            'station_name'  => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'location_code' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'photo' => 'required',
            'hours' => 'required',
            'created_at' => 'required',
            'admin_id' => 'required'
        ]);
      
        $requestData = $request->all();
        Stations::find($id)->update([
            'station_name'  => $request->station_name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'location_code' => $request->location_code,
            'address' => $request->address,
            'phone' => $request->phone,
            'photo' => $request->photo,
            'hours' => $request->hours,
            'created_at' =>$request->created_at,
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
        Stations::find($id)->delete();
        return redirect()->route('stations.index')->with('success', 'record delected successfully');
    }
}
