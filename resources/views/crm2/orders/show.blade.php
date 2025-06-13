@extends('layouts.app')

@section('title', 'Просмотр заказа')

@section('content')
<h2 class="mb-4">Просмотр заказа</h2>

@php
    $statusLabels = [
        'pending' => ['label' => 'В ожидании', 'class' => 'badge bg-warning text-dark'],
        'completed' => ['label' => 'Завершен', 'class' => 'badge bg-success'],
        'canceled' => ['label' => 'Отменен', 'class' => 'badge bg-danger'],
    ];

    $status = $order->status;
@endphp

<div class="card shadow-sm p-4 rounded bg-white">
    <p><strong>ID:</strong> {{ $order->id }}</p>
    <p><strong>Клиент:</strong> {{ $order->customer->name ?? '—' }}</p>
    <p><strong>Сумма:</strong> {{ number_format($order->total_amount, 2, ',', ' ') }} ₽</p>
    <p>
        <strong>Статус:</strong> 
        @if(isset($statusLabels[$status]))
            <span class="{{ $statusLabels[$status]['class'] }}">
                {{ $statusLabels[$status]['label'] }}
            </span>
        @else
            {{ $status }}
        @endif
    </p>
    <p><strong>Дата создания:</strong> {{ $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('d.m.Y') : '—' }}</p>

    <hr>

    <h5>Состав заказа:</h5>
    @if($order->orderItems->isEmpty())
        <p>Позиции в заказе отсутствуют.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Количество</th>
                    <th>Цена за единицу</th>
                    <th>Сумма</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->menu->name ?? '—' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2, ',', ' ') }} ₽</td>
                        <td>{{ number_format($item->price * $item->quantity, 2, ',', ' ') }} ₽</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<a href="{{ route('crm2.orders.index') }}" class="btn btn-secondary shadow-sm rounded-pill px-4 py-2 mt-4">Назад к списку</a>
@endsection
