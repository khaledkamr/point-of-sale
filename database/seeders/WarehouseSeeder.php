<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        $warehouses = [
            [
                'id' => 1,
                'name_ar' => 'مستودع النسيم',
                'location' => 'الرياض',
            ],
            [
                'id' => 2,
                'name_ar' => 'مستودع العليا',
                'location' => 'الرياض',
            ],
            [
                'id' => 3,
                'name_ar' => 'مستودع الدمام',
                'location' => 'الدمام',
            ],
        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::create($warehouse);
        }
    }
}