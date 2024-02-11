<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastItemCategory;
use Auth;

class MastItemGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MastItemGroup::with('mastItemCategory')->orderBy('mast_item_category_id', 'asc')->get();
        return view('layouts.pages.master.item_group.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item_cat = MastItemCategory::orderBy('cat_name','ASC')->get();
        return view('layouts.pages.master.item_group.create', compact('item_cat'));
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
            'part_name'=> 'required|max:255',
        ]);
        $data = new MastItemGroup();
        $data->part_name = $request->part_name;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->mast_item_category_id = $request->mast_item_category_id;
        $data->user_id = Auth::user()->id;
        $data->save();
        $notification = array('messege' => 'Item Group data save successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_item_group.index', compact('data'))->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MastItemGroup::find($id);
        return view('layouts.pages.master.item_group.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MastItemGroup::find($id);
        $item_cat = MastItemCategory::orderBy('cat_name','ASC')->where('status', 1)->get();
        return view('layouts.pages.master.item_group.edit', compact('data', 'item_cat'));
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
        $data = MastItemGroup::find($id);
        $data->part_name = $request->part_name;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->mast_item_category_id = $request->mast_item_category_id;
        $data->user_id = Auth::user()->id;
        $data->save();
        $notification = array('messege' => 'Item Group update save successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_item_group.index', compact('data'))->with($notification);
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
