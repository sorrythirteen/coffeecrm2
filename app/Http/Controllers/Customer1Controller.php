<?php

namespace App\Http\Controllers;

use App\Models\Customer1;
use Illuminate\Http\Request;

class Customer1Controller extends Controller
{
     public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Customer1::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        }

        $customers = $query->paginate(40);
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
            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:customers1,phone',
                'regex:/^\d{11}$/'
            ],
        ], [
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'email.unique' => 'Этот email уже используется. Пожалуйста, укажите другой.',
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.unique' => 'Этот номер уже существует в системе. Введите другой номер.',
            'phone.regex' => 'Номер телефона должен содержать ровно 11 цифр без пробелов и других символов. Пожалуйста, введите корректный номер.',
        ]);

        Customer1::create($validated);

        return redirect()->route('crm1.customers.index')->with('success', 'Клиент успешно добавлен!');
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
            'email' => 'nullable|email|max:255|unique:customers1,email,'.$customer->id,
            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:customers1,phone,'.$customer->id,
                'regex:/^\d{11}$/'
            ],
        ], [
            'phone.regex' => 'Номер телефона должен содержать ровно 11 цифр без пробелов и других символов. Пожалуйста, введите корректный номер.',
        ]);

        $customer->update($validated);

        return redirect()->route('crm1.customers.index')->with('success', 'Данные клиента успешно обновлены');
    }

    public function destroy($id)
    {
        $customer = Customer1::findOrFail($id);
        $customer->delete();

        return redirect()->route('crm1.customers.index')->with('success', 'Клиент успешно удалён');
    }
}