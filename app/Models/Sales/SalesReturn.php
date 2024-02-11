<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales\Sales;
use App\Models\Sales\SalesReturnDetails;
use App\Models\Master\MastWorkStation;

class SalesReturn extends Model
{
    use HasFactory;
    protected $fillable = [
        'return_no',
        'return_date',
        'remarks',
        'is_parsial',
        'status',
        'from_store_id',
        'mast_work_station_id',
        'sales_id',
        'user_id',
    ];
    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }
    public function mastWorkStation()
    {
        return $this->belongsTo(MastWorkStation::class);
    }
    public function salesReturnDetails()
    {
        return $this->hasMany(SalesReturnDetails::class);
    }
}
