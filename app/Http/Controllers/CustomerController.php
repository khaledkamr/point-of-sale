<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index(Request $request) {
        $customers = Customer::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name_ar', 'like', "%{$search}%")
                      ->orWhere('name_en', 'like', "%{$search}%");
            });
        
        if(request()->has('type')) {
            $customers->where('type', request('type'));
        }

        $customers = $customers->get();
        $types = Customer::select('type')->distinct()->pluck('type');
        
        return view('pages.customers.index', compact('customers', 'types'));
    }

    public function store(CustomerRequest $request) {
        $validated = $request->validated();

        $customer = Customer::create($validated);

        if($request->hasFile('img_url')) {
            $imagePath = $request->file('img_url')->store('customers', 'public');
            $customer->img_url = $imagePath;
            $customer->save();
        }

        return redirect()->back()->with('success', 'تم إنشاء عميل جديد بنجاح.');
    }

    public function show(Customer $customer) {
        return view('pages.customers.show', compact('customer'));
    }

    public function update(CustomerRequest $request, Customer $customer) {
        $validated = $request->validated();

        if($request->hasFile('img_url')) {
            if($customer->img_url) {
                Storage::disk('public')->delete($customer->img_url);
            }
            $imagePath = $request->file('img_url')->store('customers', 'public');
            $validated['img_url'] = $imagePath;
        }

        $customer->update($validated);

        return redirect()->back()->with('success', 'تم تحديث بيانات العميل بنجاح.');
    }

    public function destroy(Customer $customer) {
        if($customer->img_url) {
            Storage::disk('public')->delete($customer->img_url);
        }
        $customer->delete();
        return redirect()->back()->with('success', 'تم حذف العميل بنجاح.');
    }
}
