<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoBank extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_name',
        'brance_name',
        'acount_name',
        'acount_no',
        'acount_type',
        'status',
        'emp_id',
        'user_id'
    ];
    
}
