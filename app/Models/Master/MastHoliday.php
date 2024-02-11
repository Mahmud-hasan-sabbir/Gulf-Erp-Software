<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastHoliday extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'date',
        'description',
        'user_id',
        'status',
    ];
    
}
