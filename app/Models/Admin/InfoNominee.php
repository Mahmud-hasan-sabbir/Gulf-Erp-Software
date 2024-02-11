<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoNominee extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'nid_no',
        'relation',
        'mobile_no',
        'nominee_percentage',
        'profile_image',
        'status',
        'user_id',
        'emp_id'
    ];


}
