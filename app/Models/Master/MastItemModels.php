<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastItemGroup;

class MastItemModels extends Model
{
    use HasFactory;

    protected $fillable = [
        'ton',
        'coling_capacity',
        'indoor',
        'outdoor',
        'full_set',
        'mast_item_group_id',
        'user_id',
        'status',
    ];
    public function mastItemGroup()
    {
        return $this->belongsTo(MastItemGroup::class);
    }
    
}
