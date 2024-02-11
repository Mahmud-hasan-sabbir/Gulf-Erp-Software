<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReturnDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'qty',
        'price',
        'rcv_qty',
        'status',
        'sales_return_id',
        'mast_item_register_id',
        'user_id',
    ];
    public function mastItemRegister()
    {
        return $this->belongsTo(MastItemRegister::class);
    }
}
