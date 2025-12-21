<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name_ar', 
        'name_en', 
        'CR', 
        'tax_number', 
        'type', 
        'address', 
        'email', 
        'phone', 
        'IBAN', 
        'credit_limit', 
        'tax_rate', 
        'img_url', 
        'active', 
        'notes'
    ];

    public function purchaseOffers() {
        return $this->hasMany(PurchaseOffer::class);
    }

    public function purchaseOrders() {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function supplierReturns() {
        return $this->hasMany(SupplierReturn::class);
    }
}
