<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastComplaintType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id',
    ];
}
