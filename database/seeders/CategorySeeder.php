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
            [
                'id' => 1,
                'name' => 'المعجنات',
                'parent_id' => null,
            ],
            [
                'id' => 2,
                'name' => 'الكيك',
                'parent_id' => 1,
            ],
            [
                'id' => 3,
                'name' => 'الدونات',
                'parent_id' => 1,
            ],
            [
                'id' => 4,
                'name' => 'الخبز',
                'parent_id' => 1,
            ],
            [
                'id' => 5,
                'name' => 'ساندوتش',
                'parent_id' => null,
            ],
            [
                'id' => 6,
                'name' => 'تيشرت نسائي',
                'parent_id' => null,
            ],
            [
                'id' => 7,
                'name' => 'مشروبات ساخنة',
                'parent_id' => null,
            ],
            [
                'id' => 8,
                'name' => 'مشروبات باردة',
                'parent_id' => null,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}