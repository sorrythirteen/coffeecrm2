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

        $customers = $query->paginate(40);
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
            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:customers3,phone',
                'regex:/^\d{11}$/'
            ],
        ], [
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'email.unique' => 'Этот email уже используется. Пожалуйста, укажите другой.',
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.unique' => 'Этот номер уже существует в системе. Введите другой номер.',
            'phone.regex' => 'Номер телефона должен содержать ровно 11 цифр без пробелов и других символов. Пожалуйста, введите корректный номер.',
        ]);

        Customer3::create($validated);

        return redirect()->route('crm3.customers.index')->with('success', 'Клиент успешно добавлен!');
    }

    public function show($id)
    {
        $customer = Customer3::findOrFail($id);
        return view('crm3.customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer3::findOrFail($id);
        return view('crm3.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer3::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:Customers3,email,'.$customer->id,
            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:Customers3,phone,'.$customer->id,
                'regex:/^\d{11}$/'
            ],
        ], [
            'phone.regex' => 'Номер телефона должен содержать ровно 11 цифр без пробелов и других символов. Пожалуйста, введите корректный номер.',
        ]);

        $customer->update($validated);

        return redirect()->route('crm3.customers.index')->with('success', 'Данные клиента успешно обновлены');
    }

    public function destroy($id)
    {
        $customer = Customer3::findOrFail($id);
        $customer->delete();

        return redirect()->route('crm3.customers.index')->with('success', 'Клиент успешно удалён');
    }
}