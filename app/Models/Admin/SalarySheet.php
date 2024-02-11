<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastWorkStation;
use App\Models\User;

class SalarySheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary_year',
        'salary_month',
        'basic_pay',
        'house_rent_pay',
        'medical_pay',
        'conveyance_pay',
        'additional_pay',

        'basic',
        'house_rent',
        'medical',
        'conveyance',
        'additional',
        'gross',

        'pf_dedaction',
        'loan_dedaction',
        'tax_dedaction',
        'mobile_dedaction',
        'other_dedaction',
        'dedaction',
        'net_pay',

        'company_id',
        'mast_work_station_id',
        'emp_id',
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }
    public function mastWorkStation()
    {
        return $this->belongsTo(MastWorkStation::class, 'mast_work_station_id');
    }
}
