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
                'id' => 15,
                'name' => 'مستودع النسيم الغربي',
                'location' => 'الرياض',
            ],
            [
                'id' => 16,
                'name' => 'مستدوع الدمام',
                'location' => 'الدمام',
            ],
        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::create($warehouse);
        }
    }
}