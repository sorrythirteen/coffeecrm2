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

        $customers = $query->paginate(40);
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
            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:customers2,phone',
                'regex:/^\d{11}$/'
            ],
        ], [
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'email.unique' => 'Этот email уже используется. Пожалуйста, укажите другой.',
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.unique' => 'Этот номер уже существует в системе. Введите другой номер.',
            'phone.regex' => 'Номер телефона должен содержать ровно 11 цифр без пробелов и других символов. Пожалуйста, введите корректный номер.',
        ]);

        Customer2::create($validated);

        return redirect()->route('crm2.customers.index')->with('success', 'Клиент успешно добавлен!');
    }

    public function show($id)
    {
        $customer = Customer2::findOrFail($id);
        return view('crm2.customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer2::findOrFail($id);
        return view('crm2.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer2::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:customers2,email,'.$customer->id,
            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:customers2,phone,'.$customer->id,
                'regex:/^\d{11}$/'
            ],
        ], [
            'phone.regex' => 'Номер телефона должен содержать ровно 11 цифр без пробелов и других символов. Пожалуйста, введите корректный номер.',
        ]);

        $customer->update($validated);

        return redirect()->route('crm2.customers.index')->with('success', 'Данные клиента успешно обновлены');
    }

    public function destroy($id)
    {
        $customer = Customer2::findOrFail($id);
        $customer->delete();

        return redirect()->route('crm2.customers.index')->with('success', 'Клиент успешно удалён');
    }
}