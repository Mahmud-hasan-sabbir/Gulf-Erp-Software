<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\InfoPersonal;

class MastEmployeeType extends Model
{
    use HasFactory;
    protected $fillable = [
        'cat_name',
        'cat_type',
        'description',
        'status',
        'user_id',
    ];
    public function infoPersonal()
    {
        return $this->hasOne(InfoPersonal::class);
    }
}
