<?php

namespace App\Models\Master;

use App\Models\Master\MastItemRegister;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastItemGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_name',
        'description',
        'status',
        'user_id',
        'mast_item_category_id'
    ];

    public function mastItemCategory()
    {
        return $this->belongsTo(MastItemCategory::class);
    }
}
