<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastEmployeeType;
use Auth;

class MastEmployeeTypeController extends Controller
{
    public function index() {
        $employee = MastEmployeeType::latest()->get();
        return view('layouts.pages.master.employee_category.index', compact('employee'));
    }

    public function create() {
        return view('layouts.pages.master.employee_category.create');
    }

    public function store(Request $request)
    {
        $validated=$request -> validate([
            'cat_name'=> 'required|max:255',
            'cat_type'=> 'required',
            'status'=> 'required',
        ]);

        $data = new MastEmployeeType();
        $data->user_id = Auth::user()->id;
        $data->cat_name =$request->cat_name;
        $data->cat_type =$request->cat_type;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->save();
        $notification = array('messege' => 'Employee Category data save successfully.', 'alert-type' => 'success');
        return redirect()->route('must_employee_category.index')->with($notification);
    }

    public function edit($id)
    {
        $data = MastEmployeeType::find($id);
        return view('layouts.pages.master.employee_category.edit', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $data = MastEmployeeType::find($id);
        $data->user_id = Auth::user()->id;
        $data->cat_name =$request->cat_name;
        $data->cat_type =$request->cat_type;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->save();
        $notification = array('messege' => 'Employee type update successfully.', 'alert-type' => 'success');
        return redirect()->route('must_employee_category.index')->with($notification);
    }

    public function show( $id)
    {
        $data = MastEmployeeType::find($id);
        return view('layouts.pages.master.employee_category.show', compact('data'));
    }
}
