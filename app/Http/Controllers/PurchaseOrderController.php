<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOffer;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index() {
        $purchaseOrders = PurchaseOrder::query();
        $warehouses = Warehouse::all();
        $products = Product::all();
        $suppliers = Supplier::all();

        if(request()->has('search') && !empty(request()->search)) {
            $search = request()->search;
            $purchaseOrders->where(function($query) use ($search) {
                $query->where('id', 'like', "%$search%")
                      ->orWhereHas('supplier', function($q) use ($search) {
                          $q->where('name_ar', 'like', "%$search%");
                      });
            });
        }
        if(request()->has('warehouse_id') && !empty(request()->warehouse_id)) {
            $purchaseOrders->where('warehouse_id', request()->warehouse_id);
        }
        if(request()->has('status') && !empty(request()->status)) {
            $purchaseOrders->where('status', request()->status);
        }

        $purchaseOrders = $purchaseOrders->with(['supplier', 'purchaseRequest'])->paginate(100);
        
        return view('pages.purchase_orders.index', compact(
            'purchaseOrders', 
            'warehouses', 
            'products',
            'suppliers'
        ));
    }

    public function store(Request $request) {
        // return $request;
        $validated = $request->validate([
            'purchase_request_id' => 'nullable|exists:purchase_requests,id',
            'purchase_offer_id' => 'nullable|exists:purchase_offers,id',
            'warehouse_id' => 'nullable|exists:warehouses,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'total_price' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        if(isset($validated['purchase_request_id']) && isset($validated['purchase_offer_id'])) {
            $purchaseRequest = PurchaseRequest::findOrFail($validated['purchase_request_id']);
            $purchaseOffer = PurchaseOffer::findOrFail($validated['purchase_offer_id']);
        }
        
        $purchaseOrder = PurchaseOrder::create([
            'purchase_request_id' => $purchaseRequest->id ?? null,
            'purchase_offer_id' => $purchaseOffer->id ?? null,
            'warehouse_id' => $purchaseRequest->warehouse_id ?? $validated['warehouse_id'],
            'supplier_id' => $purchaseOffer->supplier_id ?? $validated['supplier_id'],
            'total_price' => $purchaseOffer->total_price ?? $validated['total_price'] ?? 0,
            'notes' => $validated['notes'] ?? null,
        ]);

        if(isset($purchaseRequest)) {
            $purchaseOrder->items()->createMany(
                $purchaseRequest->items->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => 0,
                    ];
                })->toArray()
            );
        } else {
            $purchaseOrder->items()->createMany(
                collect($request->products)->map(function ($item) {
                    return [
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'price' => 0,
                    ];
                })->toArray()
            );
        }

        if(isset($validated['purchase_request_id']) && isset($validated['purchase_offer_id'])) {
            $purchaseOffer->update(['selected' => true]);
            $purchaseRequest->update(['status' => 'مكتمل']);
        }
            
        return redirect()->back()->with('success', 'تم إنشاء أمر الشراء بنجاح.');
    }

    public function show(PurchaseOrder $purchaseOrder) {
        $purchaseOrder->load(['supplier', 'purchaseOffer', 'purchaseRequest', 'items.product']);
        return view('pages.purchase_orders.purchase_order_details', compact('purchaseOrder'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(PurchaseOrder $purchaseOrder) {
        $purchaseOrder->delete();
        return redirect()->back()->with('success', 'تم حذف أمر الشراء بنجاح.');
    }
}
