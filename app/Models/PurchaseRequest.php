<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $fillable = ['warehouse_id', 'status', 'notes'];
    
    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function items() {
        return $this->hasMany(PurchaseRequestItem::class);
    }

    public function offers() {
        return $this->hasMany(PurchaseOffer::class);
    }

    public function purchaseOrder() {
        return $this->hasOne(PurchaseOrder::class);
    }
}
