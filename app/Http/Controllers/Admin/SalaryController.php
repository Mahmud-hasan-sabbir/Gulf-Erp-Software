<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarcodeExport;
use App\Exports\ItemExport;
use PDF;
use App\Models\Admin\SalaryStructure;
use App\Models\Admin\SalarySheet;
use App\Models\Admin\HrAttendance;
use App\Models\Admin\HrLeaveApplication;
use App\Models\Master\MastHoliday;
use App\Models\Master\MastWorkStation;
use App\Models\User;
use DateTime;
use DateInterval;
use DatePeriod;

class SalaryController extends Controller
{
    public function salaryStructureIndex()
    {
        $user = User::whereNotIn('id', [1,2])->where('status', 1)->get();
        return view('layouts.pages.admin.salary.salary-structure',compact('user'));
    }
    public function salaryStructureStore(Request $request)
    {
        $salary = SalaryStructure::findOrFail($request->request_id);
        $salary->gross_salary = $request->input('gross_salary', $salary->gross_salary);
        $salary->basic = $request->basic;
        $salary->house_rent = $request->house_rent;
        $salary->medical = $request->medical;
        $salary->conveyance = $request->conveyance;
        $salary->additional = $request->additional;
        $salary->user_id = Auth::user()->id;
        $salary->save();

        $notification = array('messege' => 'Save successfully.', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    /**-------------------------------------------------------------------------------------
     * Salary => Process
     * -------------------------------------------------------------------------------------
     */
    public function salaryProcessIndex()
    {
        // Fetch users based on conditions
        $users = User::whereNotIn('id', [1, 2])->where('status', 1)->get();
        $workStation = MastWorkStation::where('status', 1)->get();

        // Pass data to the view
        return view('layouts.pages.admin.salary.salary-process', compact('users', 'workStation'));
    }
    public function salaryProcessFilter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'month' => 'required',
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Fetch users based on conditions
        $users = User::where('status', 1)
        ->when($request->userId, function ($query) use ($request) {
            $query->where('id', $request->userId);
        })
        ->when(!$request->userId, function ($query) {
            $query->whereNotIn('id', [1, 2]);
        })
        ->when($request->workStation, function ($query) use ($request) {
            $query->where('mast_work_station_id', $request->workStation);
        })->get();


        // Set up date range
        $startDate = new DateTime($request->year . '-' . $request->month . '-01');
        $endDate = new DateTime($request->year . '-' . $request->month . '-' . cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year));

        // Total Month
        $daysInMonth = $startDate->format('t');

        $interval = new DateInterval('P1D');
        $expectedDates = array_map(fn ($date) => $date->format('Y-m-d'), iterator_to_array(new DatePeriod($startDate, $interval, $endDate->modify('+1 day'))));

        // Vacation Count -->>|| 5 => Friday || 6 => Saturday
        $weeklyVacationCount = count(array_filter($expectedDates, function ($date) {
            $dayOfWeek = (new DateTime($date))->format('N');
            return $dayOfWeek == 5; // return $dayOfWeek == 5 || $dayOfWeek == 6;
        }));

        // Fetch and calculate data for each user
        $userData = [];
        foreach ($users as $user) {
            // Attendance Count -->>|| 0 => Absent || 1 => Present || 2 => Leave || 3 => Holiday || 4 => Cancel
            $attendanceData = $user->hrAttendance()
                ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->selectRaw('SUM(is_late = 1) as lateAttendance, COUNT(*) as totalAttendance, SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as `absent`, SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as `present`, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as `leave`, SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as govtVacation')
                ->first();
            $structure = $user->salaryStructure()->first();

            $lateCount = round($attendanceData->lateAttendance / 3);
            $absentCount = $attendanceData->absent;
            $presentCount = $attendanceData->present;
            $govtVacationCount = $attendanceData->govtVacation;
            $leaveCount = $attendanceData->leave;

            // Salary Calculate
            $perDaySalary = $structure->basic / 30;
            $unauthorized = $daysInMonth - (($presentCount + $absentCount) + ($weeklyVacationCount + $leaveCount + $govtVacationCount));
            if ($unauthorized < 0) {
                $unauthorized = 0;
            }

            if ($presentCount == 0) {
                $dedaction = 0.00;
                $basic = 0.00;
                $gross = 0.00;
            } elseif ($unauthorized >= 0) {
                $dedaction = $perDaySalary * ($unauthorized + $lateCount);
                $basic = $structure->basic - $dedaction;
                $gross = $basic + ($structure->house_rent + $structure->medical + $structure->conveyance + $structure->additional);
            }

            // Yearly Holiday Count => Government Holiday
            $govtHoliday = MastHoliday::whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])->count();

            if ($govtHoliday == $govtVacationCount) {
                // Build Array
                $userData[] = [
                    'employee_code' => $user->employee_code,
                    'name' => $user->name,
                    'store_name' => $user->mastWorkStation->store_name,
                    'daysInMonth' => $daysInMonth,
                    'presentCount' => $presentCount,
                    'absentCount' => $absentCount,
                    'unauthorized' => $unauthorized,
                    'leaveCount' => $leaveCount,
                    'lateTotal' => $attendanceData->lateAttendance,
                    'core_salary' => $structure->gross_salary,

                    //---Details
                    'salary_year' => $request->year,
                    'salary_month' => $request->month,
                    
                    'basic_pay' => $structure->basic,
                    'house_rent_pay' => $structure->house_rent,
                    'medical_pay' => $structure->medical,
                    'conveyance_pay' => $structure->conveyance,
                    'additional_pay' => $structure->additional,

                    'basic' => $basic,
                    'house_rent' => $structure->house_rent,
                    'medical' => $structure->medical,
                    'conveyance' => $structure->conveyance,
                    'additional' => $structure->additional,
                    
                    'gross' => $gross,
                    'dedaction' => $dedaction,
                    'net_pay' => $gross - $dedaction,
                ];
            } else {
                $userData[] = [
                    'employee_code' => $user->employee_code,
                    'name' => $user->name,
                    'daysInMonth' => $daysInMonth,
                    'presentCount' => $presentCount,
                    'absentCount' => $absentCount,
                    'leaveCount' => 'Leave Fix!',
                    'lateTotal' => $attendanceData->lateAttendance,
                    'dedaction' => $dedaction,
                    'salary' => $govtHoliday == $govtVacationCount ?  $gross : 'Holiday Fix!',
                ];
            }
        }
        
        // Pass data to the view
        return view('layouts.pages.admin.salary.load-salary-process', compact('userData'));
    }

    public function salaryProcessStore(Request $request)
    {
        $validated=$request -> validate([
            'year'=> 'required',
            'month'=> 'required',
        ]);

        // Fetch users based on conditions
        $users = User::where('status', 1)
        ->when($request->user_id, function ($query) use ($request) {
            $query->where('id', $request->user_id);
        })
        ->when(!$request->user_id, function ($query) {
            $query->whereNotIn('id', [1, 2]);
        })
        ->when($request->workStation, function ($query) use ($request) {
            $query->where('mast_work_station_id', $request->workStation);
        })
        ->get();


        // Set up date range
        $startDate = new DateTime($request->year . '-' . $request->month . '-01');
        $endDate = new DateTime($request->year . '-' . $request->month . '-' . cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year));

        // Total Month
        $daysInMonth = $startDate->format('t');

        $interval = new DateInterval('P1D');
        $expectedDates = array_map(fn ($date) => $date->format('Y-m-d'), iterator_to_array(new DatePeriod($startDate, $interval, $endDate->modify('+1 day'))));

        // Vacation Count -->>|| 5 => Friday || 6 => Saturday
        $weeklyVacationCount = count(array_filter($expectedDates, function ($date) {
            $dayOfWeek = (new DateTime($date))->format('N');
            return $dayOfWeek == 5; // return $dayOfWeek == 5 || $dayOfWeek == 6;
        }));

        // Fetch and calculate data for each user
        $userData = [];
        foreach ($users as $user) {
            // Attendance Count -->>|| 0 => Absent || 1 => Present || 2 => Leave || 3 => Holiday || 4 => Cancel
            $attendanceData = $user->hrAttendance()
                ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->selectRaw('SUM(is_late = 1) as lateAttendance, COUNT(*) as totalAttendance, SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as `absent`, SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as `present`, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as `leave`, SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as govtVacation')
                ->first();
            $structure = $user->salaryStructure()->first();

            $lateCount = round($attendanceData->lateAttendance / 3);
            $absentCount = $attendanceData->absent;
            $presentCount = $attendanceData->present;
            $govtVacationCount = $attendanceData->govtVacation;
            $leaveCount = $attendanceData->leave;

            // Salary Calculate
            $perDaySalary = $structure->basic / 30;
            $unauthorized = $daysInMonth - (($presentCount + $absentCount) + ($weeklyVacationCount + $leaveCount + $govtVacationCount));
            if ($unauthorized < 0) {
                $unauthorized = 0;
            }

            if ($presentCount == 0) {
                $dedaction = 0.00;
                $basic = 0.00;
                $gross = 0.00;
            } elseif ($unauthorized >= 0) {
                $dedaction = $perDaySalary * ($unauthorized + $lateCount);
                $basic = $structure->basic - $dedaction;
                $gross = $basic + ($structure->house_rent + $structure->medical + $structure->conveyance + $structure->additional);
            }

            // Yearly Holiday Count => Government Holiday
            $govtHoliday = MastHoliday::whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])->count();

            if ($govtHoliday == $govtVacationCount) {
                $existingData = SalarySheet::where('salary_year', $request->year)
                ->where('salary_month', $request->month)
                ->where('emp_id', $user->id)
                ->first();

                if ($existingData) {
                    // Update existing record
                    $existingData->update([
                        'basic_pay' => $structure->basic,
                        'house_rent_pay' => $structure->house_rent,
                        'medical_pay' => $structure->medical,
                        'conveyance_pay' => $structure->conveyance,
                        'additional_pay' => $structure->additional,
                        
                        'basic' => $basic,
                        'house_rent' => $structure->house_rent,
                        'medical' => $structure->medical,
                        'conveyance' => $structure->conveyance,
                        'additional' => $structure->additional,
                        'gross' => $gross,
                        
                        'pf_dedaction' => 0,
                        'loan_dedaction' => 0,
                        'tax_dedaction' => 0,
                        'mobile_dedaction' => 0,
                        'other_dedaction' => 0,
                        'dedaction' => $dedaction,
                        'net_pay' => $gross - $dedaction,
                        
                        'company_id' => 1,
                        'mast_work_station_id' => $user->mast_work_station_id,
                        'user_id' => Auth::user()->id,
                        'status' => 0,
                    ]);
                }else{
                    $data = new SalarySheet();
                    $data->fill([
                        'salary_year' => $request->year,
                        'salary_month' => $request->month,
                        'basic_pay' => $structure->basic,
                        'house_rent_pay' => $structure->house_rent,
                        'medical_pay' => $structure->medical,
                        'conveyance_pay' => $structure->conveyance,
                        'additional_pay' => $structure->additional,
                        
                        'basic' => $basic,
                        'house_rent' => $structure->house_rent,
                        'medical' => $structure->medical,
                        'conveyance' => $structure->conveyance,
                        'additional' => $structure->additional,
                        'gross' => $gross,
                        
                        'pf_dedaction' => 0,
                        'loan_dedaction' => 0,
                        'tax_dedaction' => 0,
                        'mobile_dedaction' => 0,
                        'other_dedaction' => 0,
                        'dedaction' => $dedaction,
                        'net_pay' => $gross - $dedaction,
                        
                        'company_id' => 1,
                        'mast_work_station_id' => $user->mast_work_station_id,
                        'emp_id' => $user->id,
                        'user_id' => Auth::user()->id,
                        'status' => 0,
                    ]);
                    $data->save();
                }
            } else {
                $notification = ['messege' => 'Data not saved!', 'alert-type' => 'error'];
                return redirect()->back()->with($notification);
            }
        }

        $notification = ['messege' => 'Save successfully!', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function salarySheetIndex(Request $request)
    {
        // Fetch users based on conditions
        $users = User::whereNotIn('id', [1, 2])->where('status', 1)->get();
        $workStation = MastWorkStation::where('status', 1)->get();
        
        return view('layouts.pages.admin.salary.salary-sheet', compact('users', 'workStation'));
    }
    public function salarySheetDistribution(Request $request)
    {
        // Validate the request data if needed
        $request->validate([
            'dataId' => 'required|array',
            'dataId.*.id' => 'exists:salary_sheets,id',
            'dataId.*.status' => 'required|boolean',
        ]);

        foreach ($request->dataId as $id => $data) {
            $salarySheet = SalarySheet::findOrFail($data['id']);
            $salarySheet->status = $data['status'];
            $salarySheet->save();
        }

        return redirect()->back()->with('success', 'Records updated successfully.');
    }


    public function salarySheetFilter(Request $request)
    {
        $data = SalarySheet::when($request->empId, function ($query) use ($request) {
            $query->where('emp_id', $request->empId);
        })->when($request->workStation, function ($query) use ($request) {
            $query->where('mast_work_station_id', $request->workStation);
        })->when($request->month, function ($query) use ($request) {
            $query->where('salary_month', $request->month);
        })->when($request->year, function ($query) use ($request) {
            $query->where('salary_year', $request->year);
        })->when($request->status, function ($query) use ($request) {
            $query->where('status', $request->status);
        })->get();

        return view('layouts.pages.admin.salary.load-salary-sheet', compact('data'));
    }

    public function salaryPaySlipDownload($id){
        $data = SalarySheet::where('id', $id)->orderBy('id', 'asc')->first();

        $pdf = PDF::loadView('layouts.export.salary-pay-slip', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->download('pay-slip.pdf');

        // return view('layouts.export.salary-pay-slip', compact('data'));
    }


    public function salaryPaySlipIndex(Request $request)
    {
        // Fetch users based on conditions
        $users = User::whereNotIn('id', [1, 2])->where('status', 1)->get();
        $workStation = MastWorkStation::where('status', 1)->get();

        return view('layouts.pages.admin.salary.salary-pay-slip', compact('users', 'workStation'));
    }
    
    /**-------------------------------------------------------------------------------------
     * AJAX GET DATA => Salary-Structure
     * -------------------------------------------------------------------------------------
     */

    public function getSalaryStucture(Request $request)
    {
        $data = SalaryStructure::where('emp_id', $request->id)->first();

        return response()->json($data);
    }
    
}
