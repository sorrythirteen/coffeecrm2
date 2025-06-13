<?php

namespace App\Http\Controllers;

use App\Models\Order3;
use App\Models\Customer3;
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

    $orders = $query->paginate(10);

    return view('crm3.orders.index', compact('orders'));
}


    public function create()
    {
        $customers = Customer3::all();
        return view('crm3.orders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers3,id',
            'employee_id' => 'nullable|integer',
            'order_date' => 'required|date',
            'status' => 'nullable|string|max:50',
            'total_amount' => 'nullable|numeric',
        ]);

        Order3::create($data);

        return redirect()->route('crm3.orders.index')->with('success', 'Заказ добавлен');
    }

    public function show(Order3 $order)
{
    $order->load('customer', 'orderItems');
    return view('crm3.orders.show', compact('order'));
}


    public function edit(Order3 $order)
{
    $customers = Customer3::all();
    return view('crm3.orders.edit', compact('order', 'customers'));
}


    public function update(Request $request, Order3 $order)
{
    $data = $request->validate([
        'customer_id'   => 'required|exists:customers3,id',
        'order_date'    => 'required|date',
        'status'        => 'nullable|string|max:50',
        'total_amount'  => 'nullable|numeric',
    ]);

    $order->update($data);

    return redirect()->route('crm3.orders.index')->with('success', 'Заказ обновлён');
}


    public function destroy($id)
    {
        $customer = Order3::findOrFail($id);
        $customer->delete();

        return redirect()->route('crm3.orders.index')->with('success', 'Клиент удалён');
    }
}
