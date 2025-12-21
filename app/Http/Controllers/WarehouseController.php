<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index() {
        $warehouses = Warehouse::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name_ar', 'like', "%{$search}%")
                      ->orWhere('name_en', 'like', "%{$search}%");
            });
        $locations = Warehouse::select('location')->distinct()->pluck('location');

        if(request()->has('location') && request('location') != 'all') {
            $warehouses->where('location', request('location'));
        }

        $warehouses = $warehouses->get();
        
        return view('pages.warehouses.index', compact(
            'warehouses', 
            'locations'
        ));
    }

    public function store(WarehouseRequest $request) {
        $validated = $request->validated();
        Warehouse::create($validated);

        return redirect()->back()->with('success', 'تم إنشاء مستودع جديد');
    }

    public function update(WarehouseRequest $request, Warehouse $warehouse) {
        $validated = $request->validated();
        $warehouse->update($validated);

        return redirect()->back()->with('success', 'تم تعديل بيانات المستودع بنجاح');
    }

    public function destroy(Warehouse $warehouse) {
        $name = $warehouse->name_ar;
        $warehouse->delete();
        return redirect()->back()->with('success', "تم حذف مستودع '$name' بنجاح");
    }
}
