<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\InfoPersonal;

class MastWorkStation extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_name',
        'contact_number',
        'location',
        'description',
        'status',
        'user_id',
    ];
    public function infoPersonal()
    {
        return $this->hasOne(InfoPersonal::class);
    }
}
