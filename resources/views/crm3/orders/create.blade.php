@extends('layouts.app')

@section('title', 'Создание заказа')

@section('content')
<h2 class="mb-4">Создать заказ</h2>

@if($errors->any())
    <div class="alert alert-danger shadow-sm rounded">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('crm3.orders.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="customer_id" class="form-label">Клиент</label>
        <select name="customer_id" id="customer_id" class="form-control shadow-sm rounded-pill">
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="order_date" class="form-label">Дата заказа</label>
        <input type="date" name="order_date" id="order_date" class="form-control shadow-sm rounded-pill" required>
    </div>

    <div class="mb-3">
        <label for="total_amount" class="form-label">Сумма заказа</label>
        <input type="number" step="0.01" name="total_amount" id="total_amount" class="form-control shadow-sm rounded-pill" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Статус</label>
        <select name="status" id="status" class="form-control shadow-sm rounded-pill">
            <option value="pending">В ожидании</option>
            <option value="completed">Завершен</option>
            <option value="canceled">Отменен</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success shadow-sm rounded-pill px-4">Сохранить</button>
    <a href="{{ route('crm3.orders.index') }}" class="btn btn-secondary shadow-sm rounded-pill px-4">Отмена</a>
</form>
@endsection
