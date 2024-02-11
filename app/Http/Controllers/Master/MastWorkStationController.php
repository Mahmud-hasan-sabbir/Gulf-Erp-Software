<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\MastWorkStation;
use Illuminate\Support\Facades\Validator;

class MastWorkStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MastWorkStation::latest()->get();
      
        return view('layouts.master.working_station.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.master.working_station.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=$request -> validate([
            'store_name'=> 'required|max:255',
        ]);
        $data = new MastWorkStation();
        $data->store_name = $request->store_name;
        $data->contact_number = $request->contact_number;
        $data->location = $request->location;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();

        $notification = array('messege' => 'Unit data save successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_working_station.index', compact('data'))->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MastWorkStation::find($id);
        return view('layouts.master.working_station.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MastWorkStation::find($id);
        return view('layouts.master.working_station.edit', compact('data'));
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
        $data = MastWorkStation::find($id);
        $data->store_name = $request->store_name;
        $data->contact_number = $request->contact_number;
        $data->location = $request->location;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();

        $notification = array('messege' => 'Unit data update successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_working_station.index', compact('data'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
