@extends('layouts.app')

@section('title', 'Редактировать клиента')

@section('content')
<h2 class="mb-4">Редактировать клиента</h2>

<form action="{{ route('crm1.customers.update', $customer) }}" method="POST" class="shadow-sm p-4 bg-white rounded">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label fw-semibold">Имя</label>
        <input type="text" name="name" id="name" value="{{ old('name', $customer->name) }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $customer->email) }}" class="form-control @error('email') is-invalid @enderror">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label fw-semibold">Телефон</label>
        <input type="tel" name="phone" id="phone" value="{{ old('phone', $customer->phone) }}" class="form-control @error('phone') is-invalid @enderror">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary px-5 fw-semibold rounded-pill">Обновить</button>
    <a href="{{ route('crm1.customers.index') }}" class="btn btn-secondary ms-2 rounded-pill">Отмена</a>
</form>

@endsection
