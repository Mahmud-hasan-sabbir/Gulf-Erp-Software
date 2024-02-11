<?php

namespace App\Models\Warranty;

use App\Models\Master\MastCustomer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;
    protected $fillable=[
        
        'requ_no',
        'requ_date',
        'tech_id',
        'mast_item_category_id',
        'complaint_id',
        'status',
        'remarks',
        'user_id',
    ];

    public function requisitionDetails()
    {
        return $this->hasMany(RequisitionDetails::class,'id','requ_id');
    }
    public function mastCustomer()
    {
        return $this->belongsTo(MastCustomer::class);
    }
    public function complaintType()
    {
        return $this->belongsTo(Complaint::class,'complaint_id','id');
    }
}
