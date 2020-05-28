<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gas_prices;
use App\Stations;

class GasPricesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gas = Gas_prices::with('station')->orderBy('id','asc')->paginate(10);
        $stations = Stations::get();
        return view('gas.index',['gas'=>$gas , 'stations'=>$stations]);
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
            'station_id'  => 'required',
            'price_regular' => 'required',
            'price_mid' => 'required',
            'price_premium' => 'required',
            'price_diesel' => 'required',
            'updated' => 'required',
        ]);
        $requestData = $request->all();
        Gas_prices::create([
            'station_id'  => $request->station_id,
            'price_regular' => $request->price_regular,
            'price_mid' => $request->price_mid,
            'price_premium' => $request->price_premium,
            'price_diesel' => $request->price_diesel,
            'updated' => $request->updated,
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
            'station_id'  => 'required',
            'price_regular' => 'required',
            'price_mid' => 'required',
            'price_premium' => 'required',
            'price_diesel' => 'required',
            'updated' => 'required',
        ]);
        $requestData = $request->all();
        Gas_prices::find($id)->update([
            'station_id'  => $request->station_id,
            'price_regular' => $request->price_regular,
            'price_mid' => $request->price_mid,
            'price_premium' => $request->price_premium,
            'price_diesel' => $request->price_diesel,
            'updated' => $request->updated,
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
        Gas_prices::find($id)->delete();
        return redirect()->route('gas.index')->with('success', 'record delected successfully');
    }
}
