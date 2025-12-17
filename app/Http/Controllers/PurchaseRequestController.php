<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        $purchaseRequests = PurchaseRequest::all();
        $warehouses = Warehouse::all();
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('pages.purchase_requests.index', compact(
            'purchaseRequests', 
            'warehouses', 
            'products',
            'suppliers'
        ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warehouse_id' => 'required|exists:warehouses,id',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
        ]);

        $purchaseRequest = PurchaseRequest::create([
            'warehouse_id' => $validated['warehouse_id'],
            'notes' => $validated['notes'],
            'status' => $validated['status'],
        ]);

        foreach ($validated['products'] as $product) {
            PurchaseRequestItem::create([
                'purchase_request_id' => $purchaseRequest->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
            ]);
        }

        return redirect()->back()->with('success', 'تم إنشاء طلب الشراء بنجاح.');
    }

    public function show(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->load('warehouse', 'items.product');
        return view('pages.purchase-requests.show', compact('purchaseRequest'));
    }

    public function edit(string $id)
    {
        
    }

    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        $validated = $request->validate([
            'warehouse_id' => 'required|exists:warehouses,id',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
        ]);

        $purchaseRequest->update([
            'warehouse_id' => $validated['warehouse_id'],
            'notes' => $validated['notes'],
            'status' => $validated['status'],
        ]);

        $purchaseRequest->items()->delete();
        foreach ($validated['products'] as $product) {
            PurchaseRequestItem::create([
                'purchase_request_id' => $purchaseRequest->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
            ]);
        }

        return redirect()->back()->with('success', 'تم تحديث طلب الشراء بنجاح.');
    }

    public function destroy(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->items()->delete();
        $purchaseRequest->delete();
        return redirect()->back()->with('success', 'تم حذف طلب الشراء بنجاح.');
    }
}
