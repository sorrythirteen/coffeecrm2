@extends('layouts.app')

@section('title', 'Редактирование заказа')

@section('content')
<h2 class="mb-4">Редактировать заказ #{{ $order->id }}</h2>

<form action="{{ route('crm1.orders.update', $order) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row g-3">
        <div class="col-md-6">
            <label for="customer_id" class="form-label">Клиент</label>
            <select class="form-select" id="customer_id" name="customer_id" required>
                <option value="">Выберите клиента</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-3">
            <label for="order_date" class="form-label">Дата заказа</label>
            <input type="date" class="form-control" id="order_date" name="order_date" 
       value="{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}" required>
        </div>
        
        <div class="col-md-3">
            <label for="status" class="form-label">Статус</label>
            <select class="form-select" id="status" name="status" required>
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>В ожидании</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Завершен</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Отменен</option>
            </select>
        </div>
        
        <div class="col-12">
            <h5 class="mt-4 mb-3">Позиции меню</h5>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Выбрать</th>
                            <th>Наименование</th>
                            <th>Цена</th>
                            <th>Количество</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menuItems as $menuItem)
                            @php
                                $orderItem = $order->orderItems->firstWhere('menu_id', $menuItem->id);
                                $selected = $orderItem ? true : false;
                                $quantity = $orderItem ? $orderItem->quantity : 1;
                            @endphp
                            <tr>
                                <td>
                                    <input type="checkbox" 
                                           name="menu_items[{{ $menuItem->id }}][selected]" 
                                           value="1" 
                                           {{ $selected ? 'checked' : '' }}
                                           class="form-check-input">
                                </td>
                                <td>{{ $menuItem->name }}</td>
                                <td>{{ number_format($menuItem->price, 2, ',', ' ') }} ₽</td>
                                <td>
                                    <input type="number" 
                                           name="menu_items[{{ $menuItem->id }}][quantity]" 
                                           value="{{ $quantity }}" 
                                           min="1" 
                                           class="form-control" 
                                           style="width: 80px;">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm rounded-pill">
                <i class="bi bi-save me-1"></i> Сохранить изменения
            </button>
            <a href="{{ route('crm1.orders.index') }}" class="btn btn-secondary px-4 py-2 shadow-sm rounded-pill ms-2">
                <i class="bi bi-x-circle me-1"></i> Отмена
            </a>
        </div>
    </div>
</form>
@endsection