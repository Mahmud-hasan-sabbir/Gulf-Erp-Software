<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InfoWorkExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'designation',
        'start_date',
        'end_date',
        'job_description',
        'status',
        'user_id',
        'emp_id'
    ];
    public function getDurationAttribute()
    {
        $start_date = Carbon::parse($this->attributes['start_date']);
        $end_date = Carbon::parse($this->attributes['end_date']);
        $duration = $end_date->diffInDays($start_date) + 1;

        // // Calculate years
        // $years = $end_date->diffInYears($start_date);
        // if ($years > 0) {
        //     $duration .= $years . ' day' . ($years > 1 ? 's ' : ' ');
        // }
        // // Calculate months
        // $months = $end_date->diffInMonths($start_date) % 12;
        // if ($months > 0) {
        //     $duration .= $months . ' month' . ($months > 1 ? 's ' : ' ');
        // }
        // // Calculate days
        // $days = $end_date->diffInDays($start_date) % 30;
        // if ($days > 0) {
        //     $duration .= $days . ' year' . ($days > 1 ? 's' : '');
        // }
        // return $duration;

        return $duration . ' days';
    }

}

