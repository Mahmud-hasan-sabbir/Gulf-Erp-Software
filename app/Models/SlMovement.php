<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_no',
        'reference_id',
        'reference_type_id',
        'mast_item_register_id',
        'mast_work_station_id',
        'user_id',
        'status',
        'out_date'
    ];

}
