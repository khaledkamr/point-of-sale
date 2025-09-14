<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'تم إنشاء الصنف بنجاح.');
    }

    public function show(Category $category)
    {
        $category->load('parent');
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->get();
        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'تم تحديث الصنف بنجاح.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'تم حذف الصنف بنجاح.');
    }
}
