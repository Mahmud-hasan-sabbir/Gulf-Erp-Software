<?php

namespace App\Models\Warranty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spare extends Model
{
    use HasFactory;
    protected $fillable=[
        
        'requ_no',
        'requ_date',
        'mast_item_category_id',
        'complaint_id',
        'status',
        'remarks',
        'user_id',
    ];

    public function requisitionDetails()
    {
        return $this->hasMany(SpareDetails::class);
    }
    public function mastCustomer()
    {
        return $this->belongsTo(MastCustomer::class);
    }
    public function complaintType()
    {
        return $this->belongsTo(Complaint::class);
    }
}
