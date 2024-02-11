<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\MastComplaintType;

class MastCompliantTypeController extends Controller
{
    public function index() {
        $compliant = MastComplaintType::all();
        return view('layouts.pages.master.complaint.index',compact('compliant'));
    }

    // public function create() {
    //     $data =User::orderBy('id','DESC')->where('status', 1)->get();
    //     return view('layouts.pages.master.department.create', compact('data'));
    // }

    public function store(Request $request)
    {
        $compliantType = new MastComplaintType();
        $compliantType->name = $request->name;
        $compliantType->status = $request->status;
        $compliantType->description = $request->Description;
        $compliantType->user_id = Auth::user()->id;
        $compliantType->save();
        return redirect()->back();
    }

    public function edit($id)
    {
        $compliantEdit = MastComplaintType::find($id);
        return view('layouts.pages.master.complaint.edit',compact('compliantEdit'));
    }
    
    public function update(Request $request, $id)
    {
        $compliantUpdate = MastComplaintType::find($id);
        $compliantUpdate->name = $request->name;
        $compliantUpdate->status = $request->status;
        $compliantUpdate->description = $request->Description;
        $compliantUpdate->user_id = Auth::user()->id;
        $compliantUpdate->save();

        $notification = array('messege' => 'Department data update successfully.', 'alert-type' => 'success');        
        return redirect()->route('mast_compliant_type.index')->with($notification);
    }
    public function show( $id)
    {
        $compliantView = MastComplaintType::find($id);
        return view('layouts.pages.master.complaint.show',compact('compliantView'));
    }
}
