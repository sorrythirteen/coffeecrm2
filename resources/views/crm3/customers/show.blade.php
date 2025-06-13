@extends('layouts.app')

@section('title', 'Просмотр клиента')

@section('content')
<h2 class="mb-4">Клиент: {{ $customer->name }}</h2>

<div class="card shadow-sm p-4 bg-white rounded mb-4">
    <p><strong>Email:</strong> {{ $customer->email ?? '—' }}</p>
    <p><strong>Телефон:</strong> {{ $customer->phone ?? '—' }}</p>
</div>

<a href="{{ route('crm3.customers.edit', $customer) }}" class="btn btn-warning text-white rounded-pill me-2">
    Редактировать
</a>
<a href="{{ route('crm3.customers.index') }}" class="btn btn-secondary rounded-pill">Назад к списку</a>

@endsection
