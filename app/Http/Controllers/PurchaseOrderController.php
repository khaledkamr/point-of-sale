<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'purchase_request_id' => 'nullable|exists:purchase_requests,id',
            'purchase_offer_id' => 'nullable|exists:purchase_offers,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        $purchaseRequest = PurchaseRequest::find($validated['purchase_request_id']);
        $purchaseOffer = $purchaseRequest->offers()->where('id', $validated['purchase_offer_id'])->first();
        
        $purchaseOrder = PurchaseOrder::create([
            'purchase_request_id' => $purchaseRequest->id,
            'purchase_offer_id' => $purchaseOffer->id,
            'total_price' => $purchaseOffer->total_price,
            'notes' => $validated['notes'] ?? null,
        ]);

        $purchaseOrder->items()->createMany(
            $purchaseRequest->items->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => 0,
                ];
            })->toArray()
        );

        $purchaseOffer->update(['selected' => true]);
        $purchaseRequest->update(['status' => 'مكتمل']);

        return redirect()->back()->with('success', 'تم إنشاء أمر الشراء بنجاح.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
