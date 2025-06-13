<?php

namespace App\Http\Controllers;

use App\Transaction3;
use App\Order3;
use Illuminate\Http\Request;

class Transaction3Controller extends Controller
{
    public function index()
    {
        $transactions = Transaction3::with('order')->get();
        return view('crm3.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $orders = Order3::all();
        return view('crm3.transactions.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders3,order_id',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'payment_method' => 'nullable|string|max:50',
        ]);

        Transaction3::create($data);

        return redirect()->route('crm3.transactions.index')->with('success', 'Транзакция добавлена');
    }

    public function show(Transaction3 $transaction3)
    {
        $transaction3->load('order');
        return view('crm3.transactions.show', compact('transaction3'));
    }

    public function edit(Transaction3 $transaction3)
    {
        $orders = Order3::all();
        return view('crm3.transactions.edit', compact('transaction3', 'orders'));
    }

    public function update(Request $request, Transaction3 $transaction3)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders3,order_id',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'payment_method' => 'nullable|string|max:50',
        ]);

        $transaction3->update($data);

        return redirect()->route('crm3.transactions.index')->with('success', 'Транзакция обновлена');
    }

    public function destroy(Transaction3 $transaction3)
    {
        $transaction3->delete();

        return redirect()->route('crm3.transactions.index')->with('success', 'Транзакция удалена');
    }
}
