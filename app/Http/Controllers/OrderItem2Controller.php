<?php

namespace App\Http\Controllers;

use App\OrderItem2;
use App\Order2;
use App\Menu2;
use Illuminate\Http\Request;

class OrderItem2Controller extends Controller
{
    public function index()
    {
        $orderItems = OrderItem2::with('order', 'menu')->get();
        return view('crm2.orderitems.index', compact('orderItems'));
    }

    public function create()
    {
        $orders = Order2::all();
        $menuItems = Menu2::all();
        return view('crm2.orderitems.create', compact('orders', 'menuItems'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders2,order_id',
            'item_id' => 'required|exists:menu2,item_id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        OrderItem2::create($data);

        return redirect()->route('crm2.orderitems.index')->with('success', 'Пункт заказа добавлен');
    }

    public function show(OrderItem2 $orderItem2)
    {
        $orderItem2->load('order', 'menu');
        return view('crm2.orderitems.show', compact('orderItem2'));
    }

    public function edit(OrderItem2 $orderItem2)
    {
        $orders = Order2::all();
        $menuItems = Menu2::all();
        return view('crm2.orderitems.edit', compact('orderItem2', 'orders', 'menuItems'));
    }

    public function update(Request $request, OrderItem2 $orderItem2)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders2,order_id',
            'item_id' => 'required|exists:menu2,item_id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderItem2->update($data);

        return redirect()->route('crm2.orderitems.index')->with('success', 'Пункт заказа обновлён');
    }

    public function destroy(OrderItem2 $orderItem2)
    {
        $orderItem2->delete();
        return redirect()->route('crm2.orderitems.index')->with('success', 'Пункт заказа удалён');
    }
}
