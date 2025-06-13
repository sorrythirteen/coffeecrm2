<?php

namespace App\Http\Controllers;

use App\OrderItem1;
use App\Order1;
use App\Menu1;
use Illuminate\Http\Request;

class OrderItem1Controller extends Controller
{
    public function index()
    {
        $orderItems = OrderItem1::with('order', 'menu')->get();
        return view('crm1.order_items.index', compact('orderItems'));
    }

    public function create()
    {
        $orders = Order1::all();
        $menuItems = Menu1::all();
        return view('crm1.order_items.create', compact('orders', 'menuItems'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders1,order_id',
            'item_id' => 'required|exists:menu1,item_id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        OrderItem1::create($data);

        return redirect()->route('crm1.order_items.index')->with('success', 'Позиция заказа добавлена');
    }

    public function show(OrderItem1 $orderItem1)
    {
        $orderItem1->load('order', 'menu');
        return view('crm1.order_items.show', compact('orderItem1'));
    }

    public function edit(OrderItem1 $orderItem1)
    {
        $orders = Order1::all();
        $menuItems = Menu1::all();
        return view('crm1.order_items.edit', compact('orderItem1', 'orders', 'menuItems'));
    }

    public function update(Request $request, OrderItem1 $orderItem1)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders1,order_id',
            'item_id' => 'required|exists:menu1,item_id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderItem1->update($data);

        return redirect()->route('crm1.order_items.index')->with('success', 'Позиция заказа обновлена');
    }

    public function destroy(OrderItem1 $orderItem1)
    {
        $orderItem1->delete();
        return redirect()->route('crm1.order_items.index')->with('success', 'Позиция заказа удалена');
    }
}
