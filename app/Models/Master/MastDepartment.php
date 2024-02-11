<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\InfoPersonal;
use App\Models\User;

class MastDepartment extends Model
{
    use HasFactory;
    protected $fillable = [
        'dept_name',
        'description',
        'dept_head',
        'status',
        'user_id'
    ];
    public function infoPersonal()
    {
        return $this->hasOne(InfoPersonal::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
