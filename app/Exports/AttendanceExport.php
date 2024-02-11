<?php

namespace App\Exports;

use App\Models\Admin\HrAttendance;
use Maatwebsite\Excel\Concerns\FromCollection;

class AttendanceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HrAttendance::all();
    }
}
