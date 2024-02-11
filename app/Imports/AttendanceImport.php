<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\HrAttendance;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class AttendanceImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            // Skip the row if 'id' or 'date' is null
            if (!isset($row['id'], $row['date']) || is_null($row['id']) || is_null($row['date'])) {
                \Log::warning('Skipping row due to missing or null values: ' . json_encode($row));
                return null; 
            }
            // Check if required fields exist in the $row array
            // if (!isset($row['id'], $row['date'])) {
            //     throw new Exception("Missing required fields in the import data.");
            // }
            

            $formattedDate = Carbon::parse($row['date'])->format('Y-m-d');
            $user = User::where('attendance_id', $row['id'])->first();

            if (!$user) {
                throw new Exception("User not found for attendance_id: " . $row['id']);
            }

            // Check if attendance record already exists for the specified date and finger_id
            $existingAttendance = HrAttendance::where('date', $formattedDate)
                ->where('emp_id', $user->id)->first();

            if ($existingAttendance) {
                // Update the existing record
                $existingAttendance->update([
                    "user_name"         => $row['name'],
                    "in_time"           => $row['in'],
                    "out_time"          => $row['out'],
                    "location"          => 'Office',
                    "description"       => 'Finger Maching',
                    "attendance_type"   => (strtotime($row['in']) > strtotime('09:30 AM')) ? 'L' : 'P',
                    "status"            => 1,
                    "is_late"           => (strtotime($row['in']) > strtotime('09:30 AM')) ? 1 : 0,
                    "emp_id"            => $user->id,
                    "user_id"           => Auth::user()->id,
                ]);

                return $existingAttendance;
            }

            // Create a new attendance record
            return new HrAttendance([
                "date"              => $formattedDate,
                "finger_id"         => $row['id'],
                "user_name"         => $row['name'],
                "in_time"           => $row['in'],
                "out_time"          => $row['out'],
                "location"          => 'Office',
                "description"       => 'Finger Maching',
                "attendance_type"   => (strtotime($row['in']) > strtotime('09:30 AM')) ? 'L' : 'P',
                "status"            => 1,
                "is_late"           => (strtotime($row['in']) > strtotime('09:30 AM')) ? 1 : 0,
                "emp_id"            => $user->id,
                "user_id"           => Auth::user()->id,
            ]);

        } catch (Exception $e) {
            $error = $e->getMessage();
            \Log::error('AttendanceImport Error: ' . $error);
            return ['error' => $error, 'row' => $row];
        }
    }

}
