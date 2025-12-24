<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name_ar', 
        'name_en',
        'sku',
        'img_url',
        'description', 
        'profit_margin', 
        'unit',
        'featured',
        'active',
        'category_id'
    ];
    
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    public function purchaseRequestItems() {
        return $this->hasMany(PurchaseRequestItem::class);
    }

    public function getSellingPrice() {
        // get selling price based on profit margin
    }
}
