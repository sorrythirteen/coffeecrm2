<?php

namespace App\Http\Controllers;

use App\Models\Menu1;
use App\Models\Menu2;
use Illuminate\Http\Request;

class Menu2Controller extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $query = Menu2::query();

    if ($search) {
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    }

    $menuItems = $query->paginate(10);

    return view('crm2.menu.index', compact('menuItems'));
}

    public function create()
    {
        return view('crm2.menu.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Menu2::create($data);

        return redirect()->route('crm2.menu.index')->with('success', 'Пункт меню добавлен');
    }

    public function show(Menu2 $menu)
{
    return view('crm2.menu.show', compact('menu'));
}

    public function edit(Menu2 $menu)
    {
        return view('crm2.menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu2 $menu)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $menu->update($data);

        return redirect()->route('crm2.menu.index')->with('success', 'Пункт меню обновлён');
    }

    public function destroy(Menu2 $menu)
    {
        $menu->delete();
        return redirect()->route('crm2.menu.index')->with('success', 'Пункт меню удалён');
    }
}
