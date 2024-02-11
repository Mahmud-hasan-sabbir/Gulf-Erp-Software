<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationDetails extends Model
{
    use HasFactory;
    protected $fillable=[
        'qty',
        'price',
        'status',
        'sales_id',
        'mast_item_register_id',
        'user_id',
    ];
}
