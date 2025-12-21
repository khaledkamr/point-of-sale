<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $categories = Category::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name_ar', 'like', "%{$search}%")
                      ->orWhere('name_en', 'like', "%{$search}%");
            })
            ->get();
        return view('pages.categories.index', compact('categories'));
    }


    public function store(CategoryRequest $request) {
        $validated = $request->validated();

        Category::create($validated);

        return redirect()->back()->with('success', 'تم إنشاء فئة جديدة بنجاح.');
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $category->update($validated);

        return redirect()->back()->with('success', 'تم تحديث الفئة بنجاح.');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->back()->with('success', 'تم حذف الفئة بنجاح.');
    }
}
