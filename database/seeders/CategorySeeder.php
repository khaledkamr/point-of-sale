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
                'name_ar' => 'المعجنات',
                'parent_id' => null,
            ],
            [
                'id' => 2,
                'name_ar' => 'الكيك',
                'parent_id' => 1,
            ],
            [
                'id' => 3,
                'name_ar' => 'الدونات',
                'parent_id' => 1,
            ],
            [
                'id' => 4,
                'name_ar' => 'الخبز',
                'parent_id' => 1,
            ],
            [
                'id' => 5,
                'name_ar' => 'ساندوتش',
                'parent_id' => null,
            ],
            [
                'id' => 6,
                'name_ar' => 'تيشرت نسائي',
                'parent_id' => null,
            ],
            [
                'id' => 7,
                'name_ar' => 'مشروبات ساخنة',
                'parent_id' => null,
            ],
            [
                'id' => 8,
                'name_ar' => 'مشروبات باردة',
                'parent_id' => null,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}