<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'name_ar', 
        'name_en',
        'location'
    ];
    
    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    public function purchaseRequests() {
        return $this->hasMany(PurchaseRequest::class);
    }

    public function salesInvoices() {
        return $this->hasMany(SalesInvoice::class);
    }
}
