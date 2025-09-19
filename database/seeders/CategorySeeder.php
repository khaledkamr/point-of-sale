<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Parent categories first
            [
                'id' => 1,
                'name' => 'أحذية',
                'parent_id' => null,
            ],
            [
                'id' => 4,
                'name' => 'تيشرت',
                'parent_id' => null,
            ],
            // Child categories
            [
                'id' => 2,
                'name' => 'أحذية بكعب',
                'parent_id' => 1,
            ],
            [
                'id' => 3,
                'name' => 'أحذية رياضية',
                'parent_id' => 1,
            ],
            [
                'id' => 5,
                'name' => 'تيشرت رجالي',
                'parent_id' => 4,
            ],
            [
                'id' => 6,
                'name' => 'تيشرت نسائي',
                'parent_id' => 4,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}