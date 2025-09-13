<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOfferItem extends Model
{
    protected $fillable = ['purchase_offer_id', 'product_id', 'quantity', 'price'];
    
    public function purchaseOffer() {
        return $this->belongsTo(PurchaseOffer::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
