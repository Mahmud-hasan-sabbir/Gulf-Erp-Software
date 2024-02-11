<?php

namespace App\Models\Warranty;

use App\Models\Master\MastItemGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastItemRegister;

class RequisitionDetails extends Model
{
    use HasFactory;
    protected $fillable=[
        'requ_id',
        'cat_id',
        'mast_item_register_id',
        'qty',
        'rcv_qty',
        'status',
        'user_id',
    ];

    public function purchase()
    {
        return $this->belongsTo(Requisition::class);
    }
    public function mastItemRegister()
    {
        return $this->belongsTo(MastItemRegister::class);
    }
    

}
