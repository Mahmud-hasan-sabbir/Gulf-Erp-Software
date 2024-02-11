<?php

namespace App\Models\Warranty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBillDetails extends Model
{
    use HasFactory;

    protected $fillable=[
        
        'description',
        'qty',
        'price',
        'total',
        'user_id',
    ];
}
