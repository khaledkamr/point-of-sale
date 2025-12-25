<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOffer extends Model
{
    protected $fillable = [
        'purchase_request_id', 
        'supplier_id', 
        'total_price', 
        'selected',
        'notes',
    ];
    
    public function purchaseRequest() {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function items() {
        return $this->hasMany(PurchaseOfferItem::class);
    }

    public function purchaseOrder() {
        return $this->hasOne(PurchaseOrder::class);
    }
}
