<?php

namespace App\Http\Controllers;

use App\OrderItem3;
use App\Order3;
use App\Menu3;
use Illuminate\Http\Request;

class OrderItem3Controller extends Controller
{
    public function index()
    {
        $orderItems = OrderItem3::with('order', 'menu')->get();
        return view('crm3.orderitems.index', compact('orderItems'));
    }

    public function create()
    {
        $orders = Order3::all();
        $menuItems = Menu3::all();
        return view('crm3.orderitems.create', compact('orders', 'menuItems'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders3,order_id',
            'item_id' => 'required|exists:menu3,item_id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        OrderItem3::create($data);

        return redirect()->route('crm3.orderitems.index')->with('success', 'Пункт заказа добавлен');
    }

    public function show(OrderItem3 $orderItem3)
    {
        $orderItem3->load('order', 'menu');
        return view('crm3.orderitems.show', compact('orderItem3'));
    }

    public function edit(OrderItem3 $orderItem3)
    {
        $orders = Order3::all();
        $menuItems = Menu3::all();
        return view('crm3.orderitems.edit', compact('orderItem3', 'orders', 'menuItems'));
    }

    public function update(Request $request, OrderItem3 $orderItem3)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders3,order_id',
            'item_id' => 'required|exists:menu3,item_id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderItem3->update($data);

        return redirect()->route('crm3.orderitems.index')->with('success', 'Пункт заказа обновлён');
    }

    public function destroy(OrderItem3 $orderItem3)
    {
        $orderItem3->delete();

        return redirect()->route('crm3.orderitems.index')->with('success', 'Пункт заказа удалён');
    }
}
