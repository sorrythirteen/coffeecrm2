<?php

namespace App\Http\Controllers;

use App\Models\Employee2;
use Illuminate\Http\Request;

class Employee2Controller extends Controller
{
    public function index(Request $request)
    {
        $query = Employee2::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        }

        $employees = $query->paginate(40);
        return view('crm2.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('crm2.employees.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        Employee2::create($data);
        return redirect()->route('crm2.employees.index')->with('success', 'Сотрудник добавлен');
    }

    public function show($id)
    {
        $employee = Employee2::findOrFail($id);
        return view('crm2.employees.show', compact('employee'));
    }

    public function edit(Employee2 $employee)
    {
        return view('crm2.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee2 $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'position' => 'nullable|string|max:255',
        ]);

        $employee->update($validated);
        return redirect()->route('crm2.employees.index')->with('success', 'Сотрудник обновлён.');
    }

    public function destroy(Request $request, $id)
    {
        $employee = Employee2::findOrFail($id);
        
        $request->validate([
            'delete_code' => ['required', 'string', function ($attribute, $value, $fail) use ($id) {
                if ($value !== 'DEL' . $id) {
                    $fail('Неверный код подтверждения');
                }
            }]
        ]);
        
        $employee->delete();
        return redirect()->route('crm2.employees.index')->with('success', 'Сотрудник удалён');
    }
}