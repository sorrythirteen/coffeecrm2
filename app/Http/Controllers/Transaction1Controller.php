<?php

namespace App\Http\Controllers;

use App\Transaction1;
use App\Order1;
use Illuminate\Http\Request;

class Transaction1Controller extends Controller
{
    public function index()
    {
        $transactions = Transaction1::with('order')->get();
        return view('crm1.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $orders = Order1::all();
        return view('crm1.transactions.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders1,order_id',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'payment_method' => 'nullable|string|max:50',
        ]);

        Transaction1::create($data);

        return redirect()->route('crm1.transactions.index')->with('success', 'Транзакция добавлена');
    }

    public function show(Transaction1 $transaction1)
    {
        $transaction1->load('order');
        return view('crm1.transactions.show', compact('transaction1'));
    }

    public function edit(Transaction1 $transaction1)
    {
        $orders = Order1::all();
        return view('crm1.transactions.edit', compact('transaction1', 'orders'));
    }

    public function update(Request $request, Transaction1 $transaction1)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders1,order_id',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'payment_method' => 'nullable|string|max:50',
        ]);

        $transaction1->update($data);

        return redirect()->route('crm1.transactions.index')->with('success', 'Транзакция обновлена');
    }

    public function destroy(Transaction1 $transaction1)
    {
        $transaction1->delete();
        return redirect()->route('crm1.transactions.index')->with('success', 'Транзакция удалена');
    }
}
