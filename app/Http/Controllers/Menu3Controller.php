<?php

namespace App\Http\Controllers;

use App\Models\Menu3;
use Illuminate\Http\Request;

class Menu3Controller extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $query = Menu3::query();

    if ($search) {
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    }

    $menuItems = $query->paginate(10);

    return view('crm3.menu.index', compact('menuItems'));
}

    public function create()
    {
        return view('crm3.menu.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Menu3::create($data);

        return redirect()->route('crm3.menu.index')->with('success', 'Пункт меню добавлен');
    }

    public function show(Menu3 $menu)
{
    return view('crm3.menu.show', compact('menu'));
}

    public function edit(Menu3 $menu)
    {
        return view('crm3.menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu3 $menu)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $menu->update($data);

        return redirect()->route('crm3.menu.index')->with('success', 'Пункт меню обновлён');
    }

    public function destroy(Menu3 $menu)
    {
        $menu->delete();
        return redirect()->route('crm3.menu.index')->with('success', 'Пункт меню удалён');
    }
}
