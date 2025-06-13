<?php

namespace App\Http\Controllers;

use App\Models\Customer3;
use Illuminate\Http\Request;

class Customer3Controller extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $query = Customer3::query();

    if ($search) {
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
    }

    $customers = $query->paginate(15);

    return view('crm3.customers.index', compact('customers'));
}


    public function create()
    {
        return view('crm3.customers.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255|unique:customers3,email',
        'phone' => 'nullable|string|max:20|unique:customers3,phone',
    ], [
        'email.unique' => 'Этот email уже используется. Пожалуйста, укажите другой.',
        'phone.unique' => 'Этот номер уже существует в системе. Введите другой номер.',
    ]);

    Customer3::create($validated);

    return redirect()->route('crm3.customers.index')->with('success', 'Клиент добавлен!');
}

    public function show(Customer3 $customer)
{
    return view('crm3.customers.show', compact('customer'));
}

    public function edit($id)
{
    $customer = Customer3::findOrFail($id);
    return view('crm3.customers.edit', compact('customer'));
}

    public function update(Request $request, Customer3 $customer)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
    ]);

    $customer->name = $validated['name'];
    $customer->email = $validated['email'];
    $customer->phone = $validated['phone'];
    $customer->save();

    return redirect()->route('crm3.customers.index')->with('success', 'Клиент обновлен');
}


    public function destroy($id)
    {
        $customer = Customer3::findOrFail($id);
        $customer->delete();

        return redirect()->route('crm3.customers.index')->with('success', 'Клиент удалён');
    }
}
