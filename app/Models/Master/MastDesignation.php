<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\InfoPersonal;

class MastDesignation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'desig_name',
        'description',
        'status',
        'user_id'
    ];
    public function infoPersonal()
    {
        return $this->hasOne(InfoPersonal::class);
    }
}
