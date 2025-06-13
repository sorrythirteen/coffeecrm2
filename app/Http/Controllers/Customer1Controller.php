<?php

namespace App\Http\Controllers;

use App\Models\Customer1;
use Illuminate\Http\Request;

class Customer1Controller extends Controller
{
    public function index()
    {
        $customers = Customer1::paginate(10);
        return view('crm1.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('crm1.customers.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255|unique:customers1,email',
        'phone' => 'nullable|string|max:20|unique:customers1,phone',
    ], [
        'email.unique' => 'Этот email уже используется. Пожалуйста, укажите другой.',
        'phone.unique' => 'Этот номер уже существует в системе. Введите другой номер.',
    ]);

    Customer1::create($validated);

    return redirect()->route('crm1.customers.index')->with('success', 'Клиент добавлен!');
}

    public function show($id)
    {
        $customer = Customer1::findOrFail($id);
        return view('crm1.customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer1::findOrFail($id);
        return view('crm1.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer1::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
        ]);

        $customer->update($validated);

        return redirect()->route('crm1.customers.index')->with('success', 'Клиент обновлен');
    }

    public function destroy($id)
    {
        $customer = Customer1::findOrFail($id);
        $customer->delete();

        return redirect()->route('crm1.customers.index')->with('success', 'Клиент удалён');
    }
}
