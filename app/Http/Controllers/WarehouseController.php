<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('pages.warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('pages.warehouses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        Warehouse::create($validated);

        return redirect()->back()->with('success', 'تم إنشاء مستودع جديد');
    }

    public function show(Warehouse $warehouse)
    {
        return view('pages.warehouses.show', compact('warehouse'));
    }

    public function edit(Warehouse $warehouse)
    {
        return view('pages.warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $warehouse->update($validated);

        return redirect()->back()->with('success', 'تم تعديل بيانات المستودع بنجاح');
    }

    public function destroy(Warehouse $warehouse)
    {
        $name = $warehouse->name;
        $warehouse->delete();
        return redirect()->back()->with('success', "تم حذف مستودع '$name' بنجاح");
    }
}
