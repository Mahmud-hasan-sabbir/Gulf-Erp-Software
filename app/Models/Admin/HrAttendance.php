<?php


namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastLeave;
use App\Models\User;

class HrAttendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'in_time',
        'out_time',
        'attendance_type',
        'location',
        'description',
        'user_name',
        'is_late',
        'status',
        'finger_id',
        'emp_id',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
