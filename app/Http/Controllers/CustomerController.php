<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('pages.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('pages.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'balance' => 'nullable|numeric|min:0',
        ]);

        Customer::create($validated);

        return redirect()->back()->with('success', 'تم إنشاء عميل جديد');
    }

    public function show(Customer $customer)
    {
        return view('pages.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('pages.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'balance' => 'nullable|numeric|min:0',
        ]);

        $customer->update($validated);

        return redirect()->back()->with('success', 'تم تعديل بيانات العميل بنجاح');
    }

    public function destroy(Customer $customer)
    {
        $name = $customer->name;
        $customer->delete();
        return redirect()->back()->with('success', "تم حذف العميل '$name' بنجاح");
    }
}
