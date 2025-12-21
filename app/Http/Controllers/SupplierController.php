<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    public function index(Request $request) {
        $suppliers = Supplier::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name_ar', 'like', "%{$search}%")
                      ->orWhere('name_en', 'like', "%{$search}%");
            });
        
        if(request()->has('type')) {
            $suppliers->where('type', request('type'));
        }

        $suppliers = $suppliers->get();
        $types = Supplier::select('type')->distinct()->pluck('type');
        
        return view('pages.suppliers.index', compact('suppliers', 'types'));
    }

    public function store(SupplierRequest $request) {
        $validated = $request->validated();

        $supplier = Supplier::create($validated);

        if($request->hasFile('img_url')) {
            $imagePath = $request->file('img_url')->store('suppliers', 'public');
            $supplier->img_url = $imagePath;
            $supplier->save();
        }

        return redirect()->back()->with('success', 'تم إنشاء مورد جديد بنجاح.');
    }

    public function show(Supplier $supplier) {
        return view('pages.suppliers.show', compact('supplier'));
    }

    public function update(SupplierRequest $request, Supplier $supplier) {
        $validated = $request->validated();

        if($request->hasFile('img_url')) {
            if($supplier->img_url) {
                Storage::disk('public')->delete($supplier->img_url);
            }
            $imagePath = $request->file('img_url')->store('suppliers', 'public');
            $validated['img_url'] = $imagePath;
        }

        $supplier->update($validated);

        return redirect()->back()->with('success', 'تم تحديث بيانات المورد بنجاح.');
    }

    public function destroy(Supplier $supplier) {
        if($supplier->img_url) {
            Storage::disk('public')->delete($supplier->img_url);
        }
        $supplier->delete();
        return redirect()->back()->with('success', 'تم حذف المورد بنجاح.');
    }
}
