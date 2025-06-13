@extends('layouts.app')

@section('title', 'Редактировать заказ')

@section('content')
<h2 class="mb-4">Редактировать заказ</h2>

<form action="{{ route('crm3.orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="customer_id" class="form-label">Клиент</label>
        <select name="customer_id" id="customer_id" class="form-control shadow-sm rounded-pill">
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" @if(old('customer_id', $order->customer_id) == $customer->id) selected @endif>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
        @error('customer_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="order_date" class="form-label">Дата заказа</label>
        <input
            type="date"
            name="order_date"
            id="order_date"
            class="form-control shadow-sm rounded-pill"
            value="{{ old('order_date', $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') : '') }}"
            required>
        @error('order_date')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Статус</label>
        <select name="status" id="status" class="form-control shadow-sm rounded-pill">
            <option value="pending" @if(old('status', $order->status) == 'pending') selected @endif>В ожидании</option>
            <option value="completed" @if(old('status', $order->status) == 'completed') selected @endif>Завершен</option>
            <option value="canceled" @if(old('status', $order->status) == 'canceled') selected @endif>Отменен</option>
        </select>
        @error('status')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="total_amount" class="form-label">Сумма заказа</label>
        <input
            type="number"
            step="0.01"
            name="total_amount"
            id="total_amount"
            class="form-control shadow-sm rounded-pill"
            value="{{ old('total_amount', $order->total_amount) }}"
            required>
        @error('total_amount')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success shadow-sm rounded-pill px-4">Сохранить</button>
    <a href="{{ route('crm3.orders.index') }}" class="btn btn-secondary shadow-sm rounded-pill px-4">Отмена</a>
</form>
@endsection
