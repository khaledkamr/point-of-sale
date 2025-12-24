<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::query();
        $categories = Category::all();
        $warehouses = Warehouse::all();

        if($request->has('category_id') && $request->category_id != 'all') {
            $products->where('category_id', $request->category_id);
        }

        if($request->has('warehouse_id') && $request->warehouse_id != 'all') {
            $products->whereHas('stocks', function($query) use ($request) {
                $query->where('warehouse_id', $request->warehouse_id);
            });
        }

        if($request->has('search')) {
            $searchTerm = $request->input('search');
            $products->where(function($query) use ($searchTerm) {
                $query->where('name_ar', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('name_en', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('sku', 'LIKE', "%{$searchTerm}%");
            });
        }

        $products = $products->with(['category', 'stocks.warehouse'])->paginate(100);

        return view('pages.products.index', compact('products', 'categories', 'warehouses'));
    }

    public function store(ProductRequest $request) {
        $validated = $request->validated();

        $product = Product::create($validated);

        if ($request->hasFile('img_url')) {
            $imagePath = $request->file('img_url')->store('products', 'public');
            $product->img_url = $imagePath;
            $product->save();
        }

        $product->stocks()->createMany(
            array_map(function ($warehouseId) {
                return [
                    'warehouse_id' => $warehouseId,
                    'quantity' => 0,
                ];
            }, in_array('all', $validated['warehouse_id']) ? 
                Warehouse::pluck('id')->toArray() : 
                $validated['warehouse_id'])
        );

        return redirect()->back()->with('success', 'تم إنشاء المنتج بنجاح.');
    }

    public function show(Product $product) {
        $product->load('category');
        return view('pages.products.show', compact('product'));
    }

    public function update(ProductRequest $request, Product $product) {
        $validated = $request->validated();
        $productData = Arr::only($validated, [
            'name_ar', 'name_en',
            'sku', 'description', 
            'profit_margin',  'unit',
            'featured', 'active',
            'category_id'
        ]);

        $product->update($productData);

        if($request->hasFile('img_url')) {
            if ($product->img_url && Storage::disk('public')->exists($product->img_url)) {
                Storage::disk('public')->delete($product->img_url);
            }
            $imagePath = $request->file('img_url')->store('products', 'public');
            $product->img_url = $imagePath;
        }
        
        if($request->has('warehouse_id')) {
            $existingWarehouseIds = $product->stocks()->pluck('warehouse_id')->toArray();
            $newWarehouseIds = in_array('all', $validated['warehouse_id']) ? 
                Warehouse::pluck('id')->toArray() : 
                $validated['warehouse_id'];

            $warehousesToAdd = array_diff($newWarehouseIds, $existingWarehouseIds);
            foreach ($warehousesToAdd as $warehouseId) {
                $product->stocks()->create([
                    'warehouse_id' => $warehouseId,
                    'quantity' => 0,
                ]);
            }

            $warehousesToRemove = array_diff($existingWarehouseIds, $newWarehouseIds);
            if (!empty($warehousesToRemove)) {
                $product->stocks()->whereIn('warehouse_id', $warehousesToRemove)->delete();
            }
        }

        $product->save();

        return redirect()->back()->with('success', 'تم تحديث بيانات المنتج بنجاح.');
    }

    public function destroy(Product $product) {
        $name = $product->name_ar;
        if($product->img_url && Storage::disk('public')->exists($product->img_url)) {
            Storage::disk('public')->delete($product->img_url);
        }
        $product->stocks()->delete();
        $product->delete();
        return redirect()->back()->with('success', "تم حذف المنتج '$name' بنجاح");
    }
}
