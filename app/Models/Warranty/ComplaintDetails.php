<?php

namespace App\Models\Warranty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'delivery_id',
        'status',
        'user_id',
    ];
}
