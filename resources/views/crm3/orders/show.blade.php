@extends('layouts.app')

@section('title', 'Просмотр заказа')

@section('content')
<h2 class="mb-4">Просмотр заказа</h2>

<div class="card shadow-sm p-4 rounded bg-white">
    <p><strong>ID:</strong> {{ $order->id }}</p>
    <p><strong>Клиент:</strong> {{ $order->customer->name ?? '—' }}</p>
    <p><strong>Сумма:</strong> {{ number_format($order->total_amount, 2, ',', ' ') }} ₽</p>
    <p><strong>Статус:</strong> {{ $order->status }}</p>
    <p><strong>Дата создания:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
</div>

<a href="{{ route('crm3.orders.index') }}" class="btn btn-secondary shadow-sm rounded-pill px-4 py-2 mt-4">Назад к списку</a>
@endsection
