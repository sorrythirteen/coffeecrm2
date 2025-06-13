<?php

namespace App\Http\Controllers;

use App\Models\Order3;
use App\Models\Customer3;
use App\Models\Menu3;
use Illuminate\Http\Request;

class Order3Controller extends Controller
{
    public function index(Request $request)
    {
        $query = Order3::with('customer');

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

        return view('crm3.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer3::all();
        $menuItems = Menu3::all();

        return view('crm3.orders.create', compact('customers', 'menuItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers3,id',
            'order_date' => 'required|date',
            'status' => 'required|in:pending,completed,canceled',
            'menu_items' => 'required|array',
            'menu_items.*.selected' => 'nullable|in:1',
            'menu_items.*.quantity' => 'nullable|integer|min:1',
        ]);

        $order = Order3::create([
            'customer_id' => $validated['customer_id'],
            'order_date' => $validated['order_date'],
            'status' => $validated['status'],
            'total_amount' => 0,
        ]);

        $totalAmount = 0;

        foreach ($validated['menu_items'] as $menuId => $itemData) {
            if (!empty($itemData['selected']) && isset($itemData['quantity']) && $itemData['quantity'] > 0) {
                $menuItem = Menu3::find($menuId);
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

        return redirect()->route('crm3.orders.index')->with('success', 'Заказ успешно создан');
    }

    public function show(Order3 $order)
    {
        $order->load('customer', 'orderItems.menu');
        return view('crm3.orders.show', compact('order'));
    }

    public function edit(Order3 $order)
{
    $customers = Customer3::all();
    $menuItems = Menu3::all();
    $order->load('orderItems');

    return view('crm3.orders.edit', compact('order', 'customers', 'menuItems'));
}

    public function update(Request $request, Order3 $order)
{
    $validated = $request->validate([
        'customer_id' => 'required|exists:customers3,id',
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
            $menuItem = Menu3::find($menuId);
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

    return redirect()->route('crm3.orders.index')->with('success', 'Заказ успешно обновлен');
}

    public function destroy($id)
    {
        $order = Order3::findOrFail($id);
        $order->delete();

        return redirect()->route('crm3.orders.index')->with('success', 'Заказ удалён');
    }
    
}
