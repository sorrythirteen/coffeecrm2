<?php

namespace App\Http\Controllers;

use App\Transaction2;
use App\Order2;
use Illuminate\Http\Request;

class Transaction2Controller extends Controller
{
    public function index()
    {
        $transactions = Transaction2::with('order')->get();
        return view('crm2.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $orders = Order2::all();
        return view('crm2.transactions.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders2,order_id',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'payment_method' => 'nullable|string|max:50',
        ]);

        Transaction2::create($data);

        return redirect()->route('crm2.transactions.index')->with('success', 'Транзакция добавлена');
    }

    public function show(Transaction2 $transaction2)
    {
        $transaction2->load('order');
        return view('crm2.transactions.show', compact('transaction2'));
    }

    public function edit(Transaction2 $transaction2)
    {
        $orders = Order2::all();
        return view('crm2.transactions.edit', compact('transaction2', 'orders'));
    }

    public function update(Request $request, Transaction2 $transaction2)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders2,order_id',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'payment_method' => 'nullable|string|max:50',
        ]);

        $transaction2->update($data);

        return redirect()->route('crm2.transactions.index')->with('success', 'Транзакция обновлена');
    }

    public function destroy(Transaction2 $transaction2)
    {
        $transaction2->delete();
        return redirect()->route('crm2.transactions.index')->with('success', 'Транзакция удалена');
    }
}
