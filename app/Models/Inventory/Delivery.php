<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastItemRegister;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable=[
        'serial_no',
        'deli_date',
        'warranty',
        'price',
        'status',
        'from_store',
        'mast_work_station_id',
        'sales_id',
        'mast_customer_id',
        'mast_item_register_id',
        'user_id',
    ];

    public function mastItemRegister()
    {
        return $this->belongsTo(MastItemRegister::class,'mast_item_register_id');
    }

}
