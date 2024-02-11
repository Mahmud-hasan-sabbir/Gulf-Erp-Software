<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastItemRegister;

class SalesDetails extends Model
{
    use HasFactory;
    protected $fillable=[
        'qty',
        'price',
        'deli_qty',
        'cat_id',
        'status',
        'sales_id',
        'mast_item_register_id',
        'user_id',
    ];
    public function mastItemRegister()
    {
        return $this->belongsTo(MastItemRegister::class);
    }
}
