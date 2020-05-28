<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Locations;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Locations::orderBy('id','asc')->paginate(5);
        return view('locations.index',['locations'=>$locations]);
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
            'code'  => 'required',
            'name' => 'required',
        ]);
        $requestData = $request->all();
        Locations::create([
            'code'  => $request->code,
            'name' => $request->name,
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
            'code'  => 'required',
            'name' => 'required',
        ]);
        $requestData = $request->all();
        Locations::find($id)->update([
            'code'  => $request->code,
            'name' => $request->name,
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
        Locations::find($id)->delete();
        return redirect()->route('locations.index')->with('success', 'record delected successfully');
    }
}
