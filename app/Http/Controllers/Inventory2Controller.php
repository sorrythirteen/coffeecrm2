<?php

namespace App\Http\Controllers;

use App\Inventory2;
use App\Menu2;
use Illuminate\Http\Request;

class Inventory2Controller extends Controller
{
    public function index()
    {
        $inventories = Inventory2::with('menu')->get();
        return view('crm2.inventory.index', compact('inventories'));
    }

    public function create()
    {
        $menuItems = Menu2::all();
        return view('crm2.inventory.create', compact('menuItems'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_id' => 'required|exists:menu2,item_id',
            'quantity' => 'required|integer|min:0',
            'last_updated' => 'nullable|date',
        ]);

        Inventory2::create($data);

        return redirect()->route('crm2.inventory.index')->with('success', 'Инвентарь добавлен');
    }

    public function show(Inventory2 $inventory2)
    {
        $inventory2->load('menu');
        return view('crm2.inventory.show', compact('inventory2'));
    }

    public function edit(Inventory2 $inventory2)
    {
        $menuItems = Menu2::all();
        return view('crm2.inventory.edit', compact('inventory2', 'menuItems'));
    }

    public function update(Request $request, Inventory2 $inventory2)
    {
        $data = $request->validate([
            'item_id' => 'required|exists:menu2,item_id',
            'quantity' => 'required|integer|min:0',
            'last_updated' => 'nullable|date',
        ]);

        $inventory2->update($data);

        return redirect()->route('crm2.inventory.index')->with('success', 'Инвентарь обновлён');
    }

    public function destroy(Inventory2 $inventory2)
    {
        $inventory2->delete();
        return redirect()->route('crm2.inventory.index')->with('success', 'Инвентарь удалён');
    }
}
