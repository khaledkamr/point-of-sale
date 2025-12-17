<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'مورد خبز',
            ],
            [
                'name' => 'مورد بن',
            ],
            [
                'name' => 'مورد سكر',
            ],
            [
                'name' => 'مورد دقيق',
            ],
            [
                'name' => 'مورد لحوم',
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}