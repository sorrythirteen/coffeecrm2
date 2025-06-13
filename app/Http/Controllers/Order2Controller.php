<?php

namespace App\Http\Controllers;

use App\Models\Order2;
use App\Models\Customer2;
use App\Models\Menu2;
use Illuminate\Http\Request;

class Order2Controller extends Controller
{
    public function index(Request $request)
    {
        $query = Order2::with('customer');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('customer', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                })
                ->orWhere('status', 'like', "%{$search}%")
                ->orWhereDate('order_date', $search);
            });
        }

        $orders = $query->paginate(40);

        return view('crm2.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer2::all();
        $menuItems = Menu2::all();

        return view('crm2.orders.create', compact('customers', 'menuItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers2,id',
            'order_date' => 'required|date',
            'status' => 'required|in:pending,completed,canceled',
            'menu_items' => 'required|array',
            'menu_items.*.selected' => 'nullable|in:1',
            'menu_items.*.quantity' => 'nullable|integer|min:1',
        ]);

        $order = Order2::create([
            'customer_id' => $validated['customer_id'],
            'order_date' => $validated['order_date'],
            'status' => $validated['status'],
            'total_amount' => 0,
        ]);

        $totalAmount = 0;

        foreach ($validated['menu_items'] as $menuId => $itemData) {
            if (!empty($itemData['selected']) && isset($itemData['quantity']) && $itemData['quantity'] > 0) {
                $menuItem = Menu2::find($menuId);
                if ($menuItem) {
                    $quantity = (int)$itemData['quantity'];
                    $price = $menuItem->price;

                    $order->orderItems()->create([
                        'menu_id' => $menuItem->id,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);

                    $totalAmount += $price * $quantity;
                }
            }
        }

        $order->total_amount = $totalAmount;
        $order->save();

        return redirect()->route('crm2.orders.index')->with('success', 'Заказ успешно создан');
    }

    public function show(Order2 $order)
    {
        $order->load('customer', 'orderItems.menu');
        return view('crm2.orders.show', compact('order'));
    }

    public function edit(Order2 $order)
{
    $customers = Customer2::all();
    $menuItems = Menu2::all();
    $order->load('orderItems');

    return view('crm2.orders.edit', compact('order', 'customers', 'menuItems'));
}

    public function update(Request $request, Order2 $order)
{
    $validated = $request->validate([
        'customer_id' => 'required|exists:customers2,id',
        'order_date' => 'required|date',
        'status' => 'required|in:pending,completed,canceled',
        'menu_items' => 'required|array',
        'menu_items.*.selected' => 'nullable|in:1',
        'menu_items.*.quantity' => 'nullable|integer|min:1',
    ]);

    $order->update([
        'customer_id' => $validated['customer_id'],
        'order_date' => $validated['order_date'],
        'status' => $validated['status'],
    ]);

    $order->orderItems()->delete();
    $totalAmount = 0;

    foreach ($validated['menu_items'] as $menuId => $itemData) {
        if (!empty($itemData['selected']) && isset($itemData['quantity']) && $itemData['quantity'] > 0) {
            $menuItem = Menu2::find($menuId);
            if ($menuItem) {
                $quantity = (int)$itemData['quantity'];
                $price = $menuItem->price;

                $order->orderItems()->create([
                    'menu_id' => $menuItem->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                $totalAmount += $price * $quantity;
            }
        }
    }

    $order->total_amount = $totalAmount;
    $order->save();

    return redirect()->route('crm2.orders.index')->with('success', 'Заказ успешно обновлен');
}

    public function destroy($id)
    {
        $order = Order2::findOrFail($id);
        $order->delete();

        return redirect()->route('crm2.orders.index')->with('success', 'Заказ удалён');
    }
    
}
