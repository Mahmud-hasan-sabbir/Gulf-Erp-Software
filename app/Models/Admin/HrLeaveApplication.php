<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\InfoPersonal;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Models\Master\MastLeave;
use App\Models\User;
use Auth;

class HrLeaveApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'mast_leave_id',
        'leave_contact',
        'leave_location',
        'purpose',
        'status',
        'emp_id',
        'user_id',
    ];

    public function getDurationAttribute()
    {
        $start_date = Carbon::parse($this->attributes['start_date']);
        $end_date = Carbon::parse($this->attributes['end_date']);
        $duration = $end_date->diffInDays($start_date) + 1;
        return $duration . ' days';
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }
    public function mastLeave()
    {
        return $this->belongsTo(MastLeave::class);
    }

}


