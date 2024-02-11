<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin\HrAttendance;
use App\Models\Admin\InfoPersonal;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceExport;
use App\Imports\AttendanceImport;
use App\Imports\UsersImport;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    public function index()
    {
        $employee = User::where('status', 1)->whereNotNull('attendance_id')->get();
        return view('layouts.pages.admin.attendance.index',compact('employee'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'emp_id' => 'required',
                'finger_id' => 'required',
                'date' => 'date',
                'attendance_type' => 'required',
                'in_time' => 'required',
                'out_time' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $inTime = Carbon::parse($request->in_time);
            $isLate = $inTime->greaterThan(Carbon::parse('09:30 AM')) ? 1 : 0;
            $attendanceType= $inTime->greaterThan(Carbon::parse('09:30 AM')) ? 'L' : $request->attendance_type;

            // Check if the combination of finger_id and date is unique
            $uniqueCheck = HrAttendance::where('finger_id', $request->finger_id)
                ->where('date', Carbon::parse($request->date)->format('Y-m-d')) ->doesntExist();
                
            if (!$uniqueCheck) {
                $error = [
                    'finger_id' => ['This date already has attendance records.']
                ];
                return response()->json(['errors' => $error], 422);
            }

            $data = new HrAttendance();
            $data->date = Carbon::parse($request->date)->format('Y-m-d');
            $data->in_time = $request->in_time;
            $data->out_time = $request->out_time;
            $data->attendance_type = $attendanceType;
            $data->location = $request->location;
            $data->description = $request->description;
            $data->finger_id = $request->finger_id;
            $data->emp_id = $request->emp_id;
            $data->is_late = $isLate;
            $data->status = 0; // 0 => Absent || 1 => Present || 2 => Leave || 3 => Holiday
            $data->user_id = Auth::user()->id;
            $data->save();

            // Commit if everything is successful
            DB::commit();

            $notification = ['message' => 'Manual attendance successfully!', 'alert-type' => 'success'];
            return response()->json(['data' => $data, 'notification' => $notification]);

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('An error occurred: ' . $e->getMessage());
            return 'An error occurred: ' . $e->getMessage();
        }
    }
    public function destroy($id)
    {
        $data = HrAttendance::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'Attendance record deleted successfully']);
    }

    //------ Attendance Approve
    public function attendance_approve_list()
    {
        $data = HrAttendance::with('user')->where('status', 0)->where('attendance_type', 'P')->get();
        return view('layouts.pages.admin.attendance.approve_attendance',compact('data'));
    }

    public function attendance_approve($id)
    {
        $data = HrAttendance::findOrFail($id);
        $data->status = 1; // 0 => Absent || 1 => Present || 2 => Leave || 3 => Holiday || 4 => Cancel
        $data->save();
        return redirect()->back();
    }
    public function decline($id){
        $data = HrAttendance::findOrFail($id);
        $data->status = 4; // 0 => Absent || 1 => Present || 2 => Leave || 3 => Holiday || 4 => Cancel
        $data->save();
        return redirect()->back();

    }
    /*--------------------------------------------------------------
     * SHOW AJAX CALL DATA
     *--------------------------------------------------------------
     */
    public function setUpAttendanceID(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attendanceId' => 'required',
            'attendance_id' => 'required|unique:users,attendance_id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = User::find($request->attendanceId);
        $data->attendance_id = $request->attendance_id;
        $data->save();

        return response()->json($data);
    }

    public function filterDate(Request $request)
    {  
        $finger_id = $request->input('user_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($finger_id && $start_date && $end_date ) {
            if (strtotime($end_date) > strtotime($start_date)) {
                $data = HrAttendance::whereBetween('date', [$start_date, $end_date])->where('finger_id', $finger_id)
                ->where('hr_attendances.status', 1)->join('users','users.attendance_id','hr_attendances.finger_id')
                ->select('hr_attendances.*','users.name','users.employee_code')->orderBy('date')->get();        
            }else {
                $data = HrAttendance::join('users','users.attendance_id','hr_attendances.finger_id')->where('hr_attendances.status', 1)
                ->select('hr_attendances.*','users.name','users.employee_code')->orderBy('date')->get();
            }
        } else if($finger_id) {
            $data = HrAttendance::where('finger_id', $finger_id)
            ->join('users','users.attendance_id','hr_attendances.finger_id')->where('hr_attendances.status', 1)
            ->select('hr_attendances.*','users.name','users.employee_code')->orderBy('date')->get();
        } else if($start_date && $end_date) {
            if (strtotime($end_date) > strtotime($start_date)) {
                $data = HrAttendance::whereBetween('date', [$start_date, $end_date])
                ->join('users','users.attendance_id','hr_attendances.finger_id')->where('hr_attendances.status', 1)
                ->select('hr_attendances.*','users.name','users.employee_code')->orderBy('date')->get();
            }else {
                $data = HrAttendance::join('users','users.attendance_id','hr_attendances.finger_id')->where('hr_attendances.status', 1)
                ->select('hr_attendances.*','users.name','users.employee_code')->orderBy('date')->get();
            }
        }else {
            $data = HrAttendance::join('users', 'users.attendance_id', '=', 'hr_attendances.finger_id')
            ->select('hr_attendances.*', 'users.name', 'users.employee_code')
            ->orderBy('date')->where('hr_attendances.status', 1)->get();
        }
        return view('layouts.pages.admin.attendance.load-attendance-list',compact('data'));
    }

    /*____________________________________
                Upload EXCEL
    _____________________________________*/

    public function uploadAttendance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,csv',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            $import = new AttendanceImport;
            $result = Excel::import($import, $request->file('file'));

            // Commit if everything is successful
            DB::commit();

            return response()->json(['success' => 'Import successful']);
        } catch (Exception $e) {
            DB::rollback();
            \Log::error('Upload Attendance Error: ' . $e->getMessage());

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function exportAttendance() 
    {
        return Excel::download(new AttendanceExport, 'Attendance.xlsx');
    }
}


