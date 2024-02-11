<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\InfoPersonal;
use App\Models\Master\MastDesignation;
use App\Models\Setup;
use App\Models\User;

class MastTechnicianController extends Controller
{
    public function index()
    {
        $setup = Setup::first();
        $employ_id = InfoPersonal::where('mast_designation_id', $setup->services_technician)->pluck('emp_id');
        $employees = User::whereNotIn('id', [1,2])->whereNotIn('id', $employ_id)->get();

        $technician = InfoPersonal::with('user')->with('mastDepartment')->with('mastDesignation')->where('mast_designation_id', $setup->services_technician)->get();
        $designation = MastDesignation::where('status', 1)->get();
        return view('layouts.pages.master.technician.index', compact('technician','employees','designation','setup'));
    }

    public function updateTechnician(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'mast_designation_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = InfoPersonal::where('emp_id', $request->employee_id)->first();
        $data->mast_designation_id = $request->mast_designation_id;
        $data->save();

        return response()->json('success');
    }


    /***______________________________________________________
     * SetUp Technician
     * _______________________________________________________
     */
    public function setupTechnician(Request $request)
    {
        $tech_desig = Setup::first();
        $tech_desig->install_technician = $request->install_technician;
        $tech_desig->services_technician = $request->services_technician;
        $tech_desig->save();
        return redirect()->back();
    }

    /***______________________________________________________
     * Call AJAX 
     * _______________________________________________________
     */
     public function getEmployeeInfo(Request $request)
     {
         $personalDetails =  InfoPersonal::with('mastDesignation')->with('mastDepartment')->where('emp_id',$request->id)->first()->toArray();
         $employee = User::whereNotIn('id', [1,2])->where('status', 1)->get();
         $designation = MastDesignation::where('status', 1)->get();
         return response()->json([
             'personalDetails' => $personalDetails,
             'employee' => $employee,
             'designation' => $designation,
         ]);
     }
}
