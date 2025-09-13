<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $fillable = ['warehouse_id', 'product_id', 'quantity', 'type', 'transactionable_id', 'transactionable_type'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function transactionable()
    {
        return $this->morphTo();
    }
}
