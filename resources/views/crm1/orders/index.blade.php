@extends('layouts.app')

@section('title', 'Заказы CRM 1')

@section('content')
<h2 class="mb-4">Заказы</h2>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <form action="{{ route('crm1.orders.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
        <input 
            type="search" 
            name="search" 
            value="{{ request('search') }}" 
            class="form-control shadow-sm rounded-pill border-primary" 
            placeholder="Поиск по заказам..."
        />
        <button type="submit" class="btn btn-primary ms-2 shadow-sm rounded-pill px-4 fw-semibold">
            Искать
        </button>
    </form>

    <div class="d-flex gap-2">
        <a href="{{ route('crm1.dashboard') }}" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-pill">
            <i class="bi bi-arrow-left-circle me-1"></i> Дашборд
        </a>
        <a href="{{ route('crm1.orders.create') }}" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-pill">
            Новый заказ
        </a>
    </div>
</div>

@if($orders->count())
<table class="table table-hover shadow-sm rounded overflow-hidden">
    <thead class="table-primary text-primary fw-semibold">
        <tr>
            <th>ID</th>
            <th>Клиент</th>
            <th>Сумма</th>
            <th>Статус</th>
            <th>Дата</th>
            <th class="text-center">Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr class="align-middle">
            <td>{{ $order->id }}</td>
            <td>{{ $order->customer->name ?? '—' }}</td>
            <td>{{ number_format($order->total_amount, 2, ',', ' ') }} ₽</td>
            <td>
                @php
                    $statusClasses = [
                        'pending' => 'badge bg-warning text-dark',
                        'completed' => 'badge bg-success',
                        'canceled' => 'badge bg-danger',
                    ];

                    $statusLabels = [
                        'pending' => 'В ожидании',
                        'completed' => 'Завершен',
                        'canceled' => 'Отменен',
                    ];

                    $status = $order->status;
                @endphp

                <span class="{{ $statusClasses[$status] ?? 'badge bg-secondary' }}">
                    {{ $statusLabels[$status] ?? $status }}
                </span>
            </td>
            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d.m.Y') }}</td>

            <td class="text-center" style="white-space: nowrap;">
                <a href="{{ route('crm1.orders.show', $order) }}" class="btn btn-sm btn-info me-1 shadow-sm rounded-pill">
                    <i class="bi bi-eye"></i> Просмотр
                </a>
                <form action="{{ route('crm1.orders.destroy', $order) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Удалить заказ?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger shadow-sm rounded-pill">
                        <i class="bi bi-trash"></i> Удалить
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $orders->withQueryString()->links() }}
@else
<div class="alert alert-warning shadow-sm" role="alert">
    Заказы не найдены.
</div>
@endif
@endsection
