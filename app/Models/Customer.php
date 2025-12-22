<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
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

    public function salesInvoices()
    {
        return $this->hasMany(SalesInvoice::class);
    }
}
