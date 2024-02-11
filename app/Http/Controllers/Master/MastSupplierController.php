<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\MastSupplier;

class MastSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MastSupplier::latest()->get();
      
        return view('layouts.pages.master.supplier.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.pages.master.supplier.create');
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
            'supplier_name'=> 'required|max:255',
            'contact_person'=> 'required',
        ]);
        $data = new MastSupplier();
        $data->supplier_name = $request->supplier_name;
        $data->contact_person = $request->contact_person;
        $data->email = $request->email;
        $data->phone_number = $request->phone_number;
        $data->address = $request->address;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();

        $notification = array('messege' => 'Supplier data save successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_supplier.index', compact('data'))->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MastSupplier::find($id);
        return view('layouts.pages.master.supplier.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MastSupplier::find($id);
        return view('layouts.pages.master.supplier.edit', compact('data'));
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
        $data = MastSupplier::find($id);
        $data->supplier_name = $request->supplier_name;
        $data->contact_person = $request->contact_person;
        $data->email = $request->email;
        $data->phone_number = $request->phone_number;
        $data->address = $request->address;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();

        $notification = array('messege' => 'Supplier data update successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_supplier.index', compact('data'))->with($notification);
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
