<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $warehouses = Warehouse::all();
        return view('pages.products.index', compact('products', 'categories', 'warehouses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'quantity' => 'required|numeric|min:0',
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
        ]);

        Stock::create([
            'product_id' => $product->id,
            'warehouse_id' => $validated['warehouse_id'],
            'quantity' => $validated['quantity'],
        ]);

        return redirect()->route('pages.products.index')->with('success', 'تم إنشاء المنتج بنجاح.');
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('pages.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $warehouses = Warehouse::all();
        $stock = $product->stocks()->first(); 
        return view('pages.products.edit', compact('product', 'categories', 'warehouses', 'stock'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'quantity' => 'required|numeric|min:0',
        ]);

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
        ]);

        $stock = $product->stocks()->where('warehouse_id', $validated['warehouse_id'])->first();
        if ($stock) {
            $stock->update(['quantity' => $validated['quantity']]);
        } else {
            Stock::create([
                'product_id' => $product->id,
                'warehouse_id' => $validated['warehouse_id'],
                'quantity' => $validated['quantity'],
            ]);
        }

        return redirect()->route('pages.products.index')->with('success', 'تم تحديث المنتج بنجاح.');
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->stocks()->delete();
        $product->delete();
        return redirect()->route('pages.products.index')->with('success', "تم حذف المنتج '$name' بنجاح");
    }
}
