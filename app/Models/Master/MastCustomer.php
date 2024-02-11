<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastCustomerType;

class MastCustomer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'cont_person',
        'cont_designation',
        'cont_phone',
        'cont_email',
        'web_address',
        'credit_limit',
        'remarks',
        'status',
        'mast_customer_type_id',
        'user_id',
    ];
    public function mastCustomerType()
    {
        return $this->belongsTo(MastCustomerType::class);
    }
}
