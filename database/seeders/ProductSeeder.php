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
                'name' => 'كيك الشوكولاتة',
                'category_id' => 2,
                'price' => 50.00,
            ],
            [
                'id' => 2,
                'name' => 'دونات سكر',
                'category_id' => 3,
                'price' => 10.00,
            ],
            [
                'id' => 3,
                'name' => 'خبز فرنسي',
                'category_id' => 4,
                'price' => 15.00,
            ],
            [
                'id' => 4,
                'name' => 'ساندوتش دجاج',
                'category_id' => 5,
                'price' => 30.00,
            ],
            [
                'id' => 6,
                'name' => 'قهوة عربية',
                'category_id' => 7,
                'price' => 20.00,
            ],
            [
                'id' => 7,
                'name' => 'عصير برتقال',
                'category_id' => 8,
                'price' => 15.00,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}