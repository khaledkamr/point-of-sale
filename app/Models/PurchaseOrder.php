<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'purchase_request_id',
        'warehouse_id',
        'supplier_id',
        'total_price', 
        'status',
        'notes', 
    ];

    public function purchaseRequest() {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function items() {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function receipt() {
        return $this->hasOne(Receipt::class);
    }

    public function supplierReturns() {
        return $this->hasMany(SupplierReturn::class);
    }
}
