<?php

namespace App\Models\Warranty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBill extends Model
{
    use HasFactory;

    protected $fillable=[
        
        'tracking_no',
        'mast_customer_id',
        'complaint_date',
        'tech_id',
        'bill_no',
        'bill_date',
        'remarks',
    ];
}
