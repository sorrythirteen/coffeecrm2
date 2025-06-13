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

<form action="{{ route('crm2.orders.store') }}" method="POST">
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
        <label for="status" class="form-label">Статус</label>
        <select name="status" id="status" class="form-control shadow-sm rounded-pill">
            <option value="pending">В ожидании</option>
            <option value="completed">Завершен</option>
            <option value="canceled">Отменен</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Выберите товары из меню</label>
        @foreach($menuItems as $item)
            <div class="form-check d-flex align-items-center mb-2">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    name="menu_items[{{ $item->id }}][selected]" 
                    id="menu_item_{{ $item->id }}" 
                    value="1"
                    onchange="document.getElementById('quantity_{{ $item->id }}').disabled = !this.checked"
                >
                <label class="form-check-label me-3" for="menu_item_{{ $item->id }}">
                    {{ $item->name }} ({{ number_format($item->price, 2) }} ₽)
                </label>

                <input 
                    type="number" 
                    name="menu_items[{{ $item->id }}][quantity]" 
                    id="quantity_{{ $item->id }}" 
                    value="1" 
                    min="1" 
                    class="form-control shadow-sm rounded-pill" 
                    style="width: 80px;" 
                    disabled
                >
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-success shadow-sm rounded-pill px-4">Сохранить</button>
    <a href="{{ route('crm2.orders.index') }}" class="btn btn-secondary shadow-sm rounded-pill px-4">Отмена</a>
</form>
@endsection
