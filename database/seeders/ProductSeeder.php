<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'id' => 1,
                'name' => 'تيشرت اسود',
                'description' => 'تيشرت رجالي اسود',
                'price' => '50.00',
                'category_id' => 5,
            ],
            [
                'id' => 2,
                'name' => 'تيشرت ازرق',
                'description' => 'تيشرت ازرق رجالي',
                'price' => '45.00',
                'category_id' => 5,
            ],
            [
                'id' => 3,
                'name' => 'تيشرت احمر',
                'description' => 'تيشرت نسائي احمر',
                'price' => '50.00',
                'category_id' => 6,
            ],
            [
                'id' => 4,
                'name' => 'حذاء نايك اسود',
                'description' => 'حذاء نايك اسود',
                'price' => '90.00',
                'category_id' => 3,
            ],
            [
                'id' => 5,
                'name' => 'حذاء بكعب اسود',
                'description' => 'حذاء بكعب اسود',
                'price' => '99.00',
                'category_id' => 2,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}