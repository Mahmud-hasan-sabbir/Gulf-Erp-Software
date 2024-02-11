<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastUnit;
use Auth;

class MastUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MastUnit::latest()->get();
      
        return view('layouts.pages.master.unit.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.pages.master.unit.create');
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
            'unit_name'=> 'required|max:255',
        ]);
        $data = new MastUnit();
        $data->unit_name = $request->unit_name;
        $data->description = $request->description;
        $data->mast_item_category_id = $request->mast_item_category_id;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();
        $notification = array('messege' => 'Data save successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_unit.index', compact('data'))->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MastUnit::find($id);
        return view('layouts.pages.master.unit.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MastUnit::find($id);
        return view('layouts.pages.master.unit.edit', compact('data'));
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
        $data = MastUnit::find($id);
        $data->unit_name = $request->unit_name;
        $data->description = $request->description;
        $data->mast_item_category_id = $request->mast_item_category_id;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();
        $notification = array('messege' => 'Unit data update successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_unit.index', compact('data'))->with($notification);
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
