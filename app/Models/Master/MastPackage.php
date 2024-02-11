<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'pkg_name',
        'pkg_size',
        'description',
        'status',
        'user_id'
    ];
}
