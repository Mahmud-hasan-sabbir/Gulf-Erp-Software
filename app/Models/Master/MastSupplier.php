<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastSupplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_name',
        'contact_person',
        'email',
        'phone_number',
        'address',
        'status',
        'user_id'
    ];
}
