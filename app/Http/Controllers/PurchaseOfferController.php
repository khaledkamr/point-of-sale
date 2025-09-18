<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOffer;
use App\Models\PurchaseRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOfferController extends Controller
{
    public function index()
    {
        $purchaseOffers = PurchaseOffer::with(['purchaseRequest', 'supplier'])->get();
        return view('purchase-offers.index', compact('purchaseOffers'));
    }

    public function create()
    {
        $purchaseRequests = PurchaseRequest::all();
        $suppliers = Supplier::all();
        return view('purchase-offers.create', compact('purchaseRequests', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_request_id' => 'required|exists:purchase_requests,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'total_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        PurchaseOffer::create($validated);

        return redirect()->route('purchase-requests.index')->with('success', 'تم إنشاء عرض الشراء بنجاح.');
    }

    public function show(PurchaseOffer $purchaseOffer)
    {
        $purchaseOffer->load(['purchaseRequest', 'supplier']);
        return view('purchase-offers.show', compact('purchaseOffer'));
    }

    public function edit(PurchaseOffer $purchaseOffer)
    {
        $purchaseRequests = PurchaseRequest::all();
        $suppliers = Supplier::all();
        return view('purchase-offers.edit', compact('purchaseOffer', 'purchaseRequests', 'suppliers'));
    }

    public function update(Request $request, PurchaseOffer $purchaseOffer)
    {
        $validated = $request->validate([
            'purchase_request_id' => 'required|exists:purchase_requests,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'total_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $purchaseOffer->update($validated);

        return redirect()->route('purchase-offers.index')->with('success', 'تم تحديث عرض الشراء بنجاح.');
    }

    public function destroy(PurchaseOffer $purchaseOffer)
    {
        $purchaseOffer->delete();
        return redirect()->route('purchase-offers.index')->with('success', 'تم حذف عرض الشراء بنجاح.');
    }
}
