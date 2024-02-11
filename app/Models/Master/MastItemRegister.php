<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastUnit;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastItemCategory;
use App\Models\Sales\SalesDetails;

class MastItemRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'box_code',
        'gulf_code',
        'part_no',
        'description',
        'box_qty',
        'price',
        'image',
        'warranty',
        'bar_code',
        'unit_type',
        'mast_item_models_id',
        'mast_item_category_id',
        'mast_item_group_id',
        'unit_id',
        'user_id',
    ];

    public function unit()
    {
        return $this->belongsTo(MastUnit::class);
    }
    public function mastItemCategory()
    {
        return $this->belongsTo(MastItemCategory::class);
    }
    public function mastItemGroup()
    {
        return $this->belongsTo(MastItemGroup::class);
    }
    public function salesDetails()
    {
        return $this->belongsTo(SalesDetails::class);
    }
}
