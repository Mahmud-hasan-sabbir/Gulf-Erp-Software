<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastItemCategory;
use App\Models\Inventory\StoreTransferDetails;

class StoreTransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'inv_date',
        'inv_no',
        'vat',
        'tax',
        'remarks',
        'mast_item_category_id',
        'from_store_id',
        'mast_work_station_id',
        'user_id',
        'is_parsial',
        'status',
    ];
    public function mastWorkStation()
    {
        return $this->belongsTo(MastWorkStation::class, 'mast_work_station_id');
    }
    public function fromWorkStation()
    {
        return $this->belongsTo(MastWorkStation::class, 'from_store_id');
    }
    public function mastItemCategory()
    {
        return $this->belongsTo(MastItemCategory::class);
    }
    public function storeTransferDetails()
    {
        return $this->hasMany(StoreTransferDetails::class);
    }
}
