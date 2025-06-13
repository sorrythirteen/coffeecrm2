@extends('layouts.app')

@section('title', 'Редактировать заказ')

@section('content')
<h2 class="mb-4">Редактировать заказ</h2>

<form action="{{ route('crm1.orders.update', $order->id) }}" method="POST">
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

    <hr>

    <h5>Позиции заказа</h5>
    <p class="small text-muted mb-2">Выберите товары и укажите количество</p>

    <div class="mb-3">
        @foreach($menuItems as $menu)
            @php
                $orderItem = $order->orderItems->firstWhere('menu_id', $menu->id);
                $quantity = old("items.$menu->id.quantity", $orderItem->quantity ?? 0);
            @endphp
            <div class="form-check d-flex align-items-center mb-2">
                <input 
                    class="form-check-input me-2" 
                    type="checkbox" 
                    name="items[{{ $menu->id }}][selected]" 
                    id="menu-item-{{ $menu->id }}"
                    value="1"
                    @if($quantity > 0) checked @endif
                >
                <label class="form-check-label flex-grow-1" for="menu-item-{{ $menu->id }}">
                    {{ $menu->name }} — {{ number_format($menu->price, 2, ',', ' ') }} ₽
                </label>
                <input 
                    type="number" 
                    name="items[{{ $menu->id }}][quantity]" 
                    class="form-control form-control-sm ms-3" 
                    style="width: 80px;" 
                    min="0" 
                    value="{{ $quantity }}" 
                    @if($quantity == 0) disabled @endif
                >
            </div>
        @endforeach
        @error('items')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success shadow-sm rounded-pill px-4">Сохранить</button>
    <a href="{{ route('crm1.orders.index') }}" class="btn btn-secondary shadow-sm rounded-pill px-4">Отмена</a>
</form>

<script>
    document.querySelectorAll('input[type=checkbox][name^="items"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const numberInput = this.closest('div').querySelector('input[type=number]');
            if(this.checked){
                numberInput.disabled = false;
                if (numberInput.value == 0) numberInput.value = 1;
            } else {
                numberInput.disabled = true;
                numberInput.value = 0;
            }
        });
    });
</script>

@endsection
