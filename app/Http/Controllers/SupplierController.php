<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('pages.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('pages.suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        Supplier::create($validated);

        return redirect()->back()->with('success', 'تم إنشاء المورد بنجاح.');
    }

    public function show(Supplier $supplier)
    {
        return view('pages.suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('pages.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $supplier->update($validated);

        return redirect()->back()->with('success', 'تم تحديث المورد بنجاح.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->back()->with('success', 'تم حذف المورد بنجاح.');
    }
}
