<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        $stocks = [
            [
                'product_id' => 1,
                'warehouse_id' => 16,
                'quantity' => 100,
            ],
            [
                'product_id' => 2,
                'warehouse_id' => 15,
                'quantity' => 100,
            ],
            [
                'product_id' => 3,
                'warehouse_id' => 15,
                'quantity' => 100,
            ],
            [
                'product_id' => 4,
                'warehouse_id' => 15,
                'quantity' => 50,
            ],
            [
                'product_id' => 5,
                'warehouse_id' => 15,
                'quantity' => 40,
            ],
        ];

        foreach ($stocks as $stock) {
            Stock::create($stock);
        }
    }
}