<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryStructure extends Model
{
    use HasFactory;
    protected $fillable = [
        'gross_salary',
        'basic',
        'house_rent',
        'medical',
        'conveyance',
        'additional',
        'overtime',
        'emp_id',
        'user_id',
        'status',
    ];
}
