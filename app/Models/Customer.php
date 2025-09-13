<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'type', 'phone', 'balance'];

    public function salesInvoices()
    {
        return $this->hasMany(SalesInvoice::class);
    }
}
