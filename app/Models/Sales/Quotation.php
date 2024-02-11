<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastCustomer;
use App\Models\Master\MastItemCategory;
use App\Models\Sales\QuotationDetails;

class Quotation extends Model
{
    use HasFactory;
    protected $fillable = [
        'quot_date',
        'quot_no',
        'vat',
        'tax',
        'remarks',
        'status',
        'is_sales',
        'mast_item_category_id',
        'mast_customer_id',
        'user_id'
    ];
    public function mastCustomer()
    {
        return $this->belongsTo(MastCustomer::class);
    }
    public function mastItemCategory()
    {
        return $this->belongsTo(MastItemCategory::class);
    }
    public function quotationDetails()
    {
        return $this->hasMany(QuotationDetails::class);
    }

}
