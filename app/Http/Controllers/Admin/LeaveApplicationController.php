<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin\HrLeaveApplication;
use App\Models\Admin\HrAttendance;
use App\Models\Master\MastDesignation;
use App\Models\Master\MastLeave;
use App\Models\User;
use Carbon\Carbon;
use DateTime;

class LeaveApplicationController extends Controller
{
    public function emergency_leave()
    {
        $leave_type =MastLeave::where('status', 1)->get();
        $employee =User::where('status', 1)->get();
        return view('layouts.pages.admin.leave.index',compact('leave_type','employee'));
    }
    public function leave_application()
    {
        $data = HrLeaveApplication::with('mastLeave', 'user')->orderBy('start_date', 'asc')->get();
        $leave_type = MastLeave::where('status', 1)->get();
        return view('layouts.pages.admin.leave.self_leave',compact('leave_type','data'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'emp_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'mast_leave_id' => 'required',
                'leave_contact' => 'required'
            ], [
                'emp_id.required' => 'Employee ID is required.',
                'start_date.required' => 'Start date is required.',
                'end_date.required' => 'End date is required.',
                'mast_leave_id.required' => 'Master leave ID is required.',
                'leave_contact.required' => 'Leave contact is required.'
            ]);
            
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $data = new HrLeaveApplication();
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->mast_leave_id = $request->mast_leave_id;
            $data->leave_contact = $request->leave_contact;
            $data->leave_location = $request->leave_location;
            $data->purpose = $request->purpose;
            $data->status = $request->emg_leave ? '2' : '0';
            $data->emp_id = $request->emp_id;
            $data->user_id = Auth::user()->id;
            $data->save();
            
            // Create a Carbon instance for the start date
            $currentDate = Carbon::parse($request->start_date);

            // Loop through each day in the date range
            while ($currentDate <= Carbon::parse($request->end_date)) {
                $attendanceData = HrAttendance::updateOrCreate(
                    [
                        'date' => $currentDate->format('Y-m-d'),
                        'emp_id' => $request->emp_id,
                    ],
                    [
                        'in_time' => '09:00:00',
                        'out_time' => '17:00:00',
                        'attendance_type' => $data->mastLeave->leave_code,
                        'location' => $request->leave_location,
                        'description' => $request->purpose,
                        'finger_id' => $request->finger_id,
                        'is_late' => 0, // In Time => 0 || Late => 1
                        'status' => 2, //Absent => 0 || Present => 1 || Leave => 2 || Holiday => 3
                        'emp_id' => $request->emp_id,
                        'user_id' => Auth::user()->id,
                    ]
                );

                // Increment the date for the next iteration
                $currentDate->addDay();
            }
            
            //----Leave Name
            $leave_data =MastLeave::where('id', $request->mast_leave_id)->first();
            $data->name =$request->employee_name;
            $data->leave_name =$leave_data->leave_name;
            //----Date Formate
            $date1 = Carbon::createFromFormat('Y-m-d', $request->start_date);
            $date2 = Carbon::createFromFormat('Y-m-d', $request->end_date);
            $data->formattedDate1 = $date1->format('j F, Y');
            $data->formattedDate2 = $date2->format('j F, Y');
            //----Duration Single
            $startDate = new DateTime($request->start_date);
            $endDate = new DateTime($request->end_date);
            $interval = $startDate->diff($endDate);
            $data->duration = $interval->format('%d days');
            
            // Commit if everything is successful
            DB::commit();

            return response()->json($data);
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Cash transaction error: ' . $e->getMessage());
            return 'An error occurred during the cash transaction: ' . $e->getMessage();
        }
    }

    public function dept_approve_list()
    {
        $data =HrLeaveApplication::with('mastLeave', 'user')->where('status', 0)->get();

        return view('layouts.pages.admin.leave.approve_dept',compact('data'));
    }
    public function dept_approve($id)
    {
        $data = HrLeaveApplication::findOrFail($id);
        $data->status = '1';
        $data->save();

        $notification=array('messege'=>'Leave approve successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
    public function hr_approve_list()
    {
        $data =HrLeaveApplication::with('mastLeave', 'user')->where('status', 1)->get();

        return view('layouts.pages.admin.leave.approve_hr',compact('data'));
    }
    public function hr_approve($id)
    {
        $data = HrLeaveApplication::findOrFail($id);
        $data->status = 2;
        $data->save();

        $notification=array('messege'=>'Leave approve successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function decline($id){
        $data = HrLeaveApplication::findOrFail($id);
        $data->status = 3;
        $data->save();

        $notification=array('messege'=>'Canceled successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function getEmployeeCode(Request $request)
    {
        try {
            $user = User::with('hrLeaveApplication')->findOrFail($request->userId);
            return response()->json(optional($user)->jsonSerialize());
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response()->json(['error' => 'User not found'], 404);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    //---View Attendance List
    public function getLeaveApplication_report(Request $request)
    {
        $data =HrLeaveApplication::with('mastLeave', 'user')->where('status', 2)->where('emp_id', $request->userId)->get();
 
        return view('layouts.pages.admin.leave.leave-details-view', compact('data'));
        
    }
}
