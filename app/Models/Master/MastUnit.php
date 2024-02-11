<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_name',
        'description',
        'status',
        'user_id',
        'mast_item_category_id'
    ];
}
