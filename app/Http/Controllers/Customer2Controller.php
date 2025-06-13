<?php

namespace App\Http\Controllers;

use App\Models\Customer2;
use Illuminate\Http\Request;

class Customer2Controller extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $query = Customer2::query();

    if ($search) {
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
    }

    $customers = $query->paginate(15);

    return view('crm2.customers.index', compact('customers'));
}


    public function create()
    {
        return view('crm2.customers.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255|unique:customers2,email',
        'phone' => 'nullable|string|max:20|unique:customers2,phone',
    ], [
        'email.unique' => 'Этот email уже используется. Пожалуйста, укажите другой.',
        'phone.unique' => 'Этот номер уже существует в системе. Введите другой номер.',
    ]);

    Customer2::create($validated);

    return redirect()->route('crm2.customers.index')->with('success', 'Клиент добавлен!');
}


    public function show(Customer2 $customer)
{
    return view('crm2.customers.show', compact('customer'));
}

    public function edit($id)
{
    $customer = Customer2::findOrFail($id);
    return view('crm2.customers.edit', compact('customer'));
}

    public function update(Request $request, Customer2 $customer)
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

    return redirect()->route('crm2.customers.index')->with('success', 'Клиент обновлен');
}


    public function destroy($id)
    {
        $customer = Customer2::findOrFail($id);
        $customer->delete();

        return redirect()->route('crm2.customers.index')->with('success', 'Клиент удалён');
    }
}
