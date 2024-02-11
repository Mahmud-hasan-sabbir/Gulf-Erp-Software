<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\HrLeaveApplication;
use App\Models\User;

class MastLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_name',
        'max_limit',
        'leave_code',
        'yearly_limit',
        'description',
        'status',
        'user_id',
    ];

    public function leaveApplication()
    {
        return $this->hasOne(HrLeaveApplication::class);
    }
    
}
