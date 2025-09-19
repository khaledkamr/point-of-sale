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
                'name' => 'شركة نايك',
                'email' => 'nike@gmail.com',
                'phone' => '059789824',
            ],
            [
                'name' => 'شركة توب تين',
                'email' => 'top10@gmail.com',
                'phone' => '0597292144',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}