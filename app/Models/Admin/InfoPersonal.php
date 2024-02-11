<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastDepartment;
use App\Models\Master\MastDesignation;
use App\Models\Master\MastEmployeeType;
use App\Models\Master\MastWorkStation;
use App\Models\User;

class InfoPersonal extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_of_birth',
        'employee_gender',
        'nid_no',
        'blood_group',
        'mast_department_id',
        'mast_designation_id',
        'mast_employee_type_id',
        'mast_work_station_id',
        'number_official',
        'email_official',
        'joining_date',
        'service_length',
        'gross_salary',
        'reporting_boss',
        'is_reporting_boss',
        
        'division_present',
        'district_present',
        'upazila_present',
        'union_present',
        'thana_present',
        'post_code_present',
        'address_present',

        'division_permanent',
        'district_permanent',
        'upazila_permanent',
        'union_permanent',
        'thana_permanent',
        'post_code_permanent',
        'address_permanent',

        'passport_no',
        'driving_license',
        'marital_status',
        'house_phone',
        'father_name',
        'mother_name',
        'birth_certificate_no',
        'emg_person_name',
        'emg_phone_number',
        'emg_relationship',
        'emg_address',
        'status',
        'user_id',
        'emp_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mastDepartment()
    {
        return $this->belongsTo(MastDepartment::class);
    }
    public function mastDesignation()
    {
        return $this->belongsTo(MastDesignation::class);
    }
    public function mastEmployeeType()
    {
        return $this->belongsTo(MastEmployeeType::class);
    }
    public function mastWorkStation()
    {
        return $this->belongsTo(MastWorkStation::class);
    }
    public function reportingBoss()
    {
        return $this->belongsTo(User::class, 'reporting_boss', 'id');
    }
    public function employeeName()
    {
        return $this->belongsTo(User::class, 'emp_id', 'id');
    }

}
