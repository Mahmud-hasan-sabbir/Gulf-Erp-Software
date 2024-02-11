<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
//______HR & ADMIN
use App\Models\Admin\HrLeaveApplication;
use App\Models\Admin\InfoPersonal;
use App\Models\Admin\InfoEducational;
use App\Models\Admin\InfoWorkExperience;
use App\Models\Admin\InfoBank;
use App\Models\Admin\InfoNominee;
use App\Models\Admin\HrAttendance;
use App\Models\Admin\SalaryStructure;
use App\Models\Master\MastDepartment;
use App\Models\Master\MastWorkStation;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'contact_number',
        'email',
        'password',
        'employee_code',
        'profile_photo_path',
        'mast_work_station_id',
        'attendance_id',
        'is_admin',
        'status',
    ];
    public function infoPersonal()
    {
        return $this->hasOne(InfoPersonal::class,'emp_id');
    }
    public function infoEducational()
    {
        return $this->hasMany(InfoEducational::class,'emp_id');
    }
    public function infoWorkExperience()
    {
        return $this->hasMany(InfoWorkExperience::class,'emp_id');
    }
    public function infoBank()
    {
        return $this->hasMany(InfoBank::class,'emp_id');
    }
    public function infoNominee()
    {
        return $this->hasMany(InfoNominee::class,'emp_id');
    }
    public function attendance()
    {
        return $this->hasMany(HrAttendance::class);
    }
    public function mastWorkStation()
    {
        return $this->belongsTo(MastWorkStation::class);
    }
    
    //____________ DATA
    public function hrLeaveApplication()
    {
        return $this->hasMany(HrLeaveApplication::class, 'emp_id');
    }
    public function hrAttendance()
    {
        return $this->hasMany(HrAttendance::class, 'emp_id');
    }
    public function salaryStructure()
    {
        return $this->hasMany(SalaryStructure::class, 'emp_id');
    }
    //____________ SABBIR DATA
    public function employeeCode()
    {
    return $this->hasOne(InfoPersonal::class,'user_id','id');
    }
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}


?>