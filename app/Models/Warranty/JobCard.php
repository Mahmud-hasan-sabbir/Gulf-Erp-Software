<?php

namespace App\Models\Warranty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class JobCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'tracking_no',
        'job_date',
        'tech_id',
        'observe_details',
        'is_next_visit',
        'next_date',
        'is_complete',
        'is_spare_parts',
        'note',
        'user_id',
    ];

    public function tecName()
    {
        return $this->hasOne(User::class,'id','tech_id');
    }
}
