<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = ['purchase_offer_id', 'supplier_id', 'total_price', 'status'];

    public function purchaseOffer() {
        return $this->belongsTo(PurchaseOffer::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function items() {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    public function supplierReturns()
    {
        return $this->hasMany(SupplierReturn::class);
    }
}
