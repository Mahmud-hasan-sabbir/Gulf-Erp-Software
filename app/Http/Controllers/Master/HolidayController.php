<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\HrAttendance;
use App\Models\Master\MastHoliday;
use App\Models\User;
use Carbon\Carbon;

class HolidayController extends Controller
{
    public function index() {
        $data = MastHoliday::latest()->get();
        return view('layouts.master.holidays.index', compact('data'));
    }

    public function create() {
        return view('layouts.master.holidays.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated=$request -> validate([
                'name'=> 'required|max:255',
                'date'=> 'required',
                'status'=> 'required',
            ]);

            $data = new MastHoliday();
            $data->name = $request->name;
            $data->date = $request->date;
            $data->description = $request->description;
            $data->status = $request->status;
            $data->user_id = Auth::user()->id;
            $data->save();

            $users = User::where('status', 1)->whereNotIn('id', [1, 2])->get();

            foreach ($users as $user) {
                $attendance = HrAttendance::firstOrNew(
                    [
                        'date' => Carbon::parse($request->date)->format('Y-m-d'),
                        'emp_id' => $user->id,
                    ]
                );
                $attendance->fill([
                    'in_time' => '09:00:00',
                    'out_time' => '17:00:00',
                    'location' => $request->name,
                    'description' => $request->description,
                    'user_name' => $user->name,
                    'finger_id' => $user->attendance_id,
                    'is_late' => 0,
                    'status' => 3, // 0 => Absent || 1 => Present || 2 => Leave || 3 => Holiday
                    'user_id' => Auth::user()->id,
                    'attendance_type' => $attendance->exists ? $attendance->attendance_type : 'GL', // Old || New
                ]);
                // Save the record
                $attendance->save();
            }

            // Commit if everything is successful
            DB::commit();

            $notification = array('messege' => 'Department save successfully.', 'alert-type' => 'success');
            return redirect()->route('mast_holidays.index')->with($notification);

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('An error occurred: ' . $e->getMessage());
            return 'An error occurred: ' . $e->getMessage();
        }
    }

    public function edit($id)
    {
        $data = MastHoliday::find($id);
        return view('layouts.master.holidays.edit', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $data = MastHoliday::find($id);
        $data->name = $request->name;
        $data->date = $request->date;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();
        $notification = array('messege' => 'Department data update successfully.', 'alert-type' => 'success');        
        return redirect()->route('mast_holidays.index')->with($notification);
    }
    public function show( $id)
    {
        $data = MastDepartment::find($id);
        return view('layouts.master.holidays.show', compact('data'));
    }
}
