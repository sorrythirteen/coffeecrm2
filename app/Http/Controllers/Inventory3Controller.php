<?php

namespace App\Http\Controllers;

use App\Inventory3;
use App\Menu3;
use Illuminate\Http\Request;

class Inventory3Controller extends Controller
{
    public function index()
    {
        $inventories = Inventory3::with('menu')->get();
        return view('crm3.inventory.index', compact('inventories'));
    }

    public function create()
    {
        $menuItems = Menu3::all();
        return view('crm3.inventory.create', compact('menuItems'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_id' => 'required|exists:menu3,item_id',
            'quantity' => 'required|integer|min:0',
            'last_updated' => 'required|date',
        ]);

        Inventory3::create($data);

        return redirect()->route('crm3.inventory.index')->with('success', 'Запись инвентаря добавлена');
    }

    public function show(Inventory3 $inventory3)
    {
        $inventory3->load('menu');
        return view('crm3.inventory.show', compact('inventory3'));
    }

    public function edit(Inventory3 $inventory3)
    {
        $menuItems = Menu3::all();
        return view('crm3.inventory.edit', compact('inventory3', 'menuItems'));
    }

    public function update(Request $request, Inventory3 $inventory3)
    {
        $data = $request->validate([
            'item_id' => 'required|exists:menu3,item_id',
            'quantity' => 'required|integer|min:0',
            'last_updated' => 'required|date',
        ]);

        $inventory3->update($data);

        return redirect()->route('crm3.inventory.index')->with('success', 'Запись инвентаря обновлена');
    }

    public function destroy(Inventory3 $inventory3)
    {
        $inventory3->delete();

        return redirect()->route('crm3.inventory.index')->with('success', 'Запись инвентаря удалена');
    }
}
