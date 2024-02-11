<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory\Purchase;
use App\Models\Master\MastItemRegister;

class PurchaseDetails extends Model
{
    use HasFactory;
    protected $fillable=[
        'qty',
        'price',
        'rcv_qty',
        'cat_id',
        'status',
        'purchase_id',
        'mast_item_register_id',
        'user_id',
    ];
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function mastItemRegister()
    {
        return $this->belongsTo(MastItemRegister::class);
    }
}
