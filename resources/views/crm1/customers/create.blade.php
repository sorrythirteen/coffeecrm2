@extends('layouts.app')

@section('title', 'Добавление клиента')

@section('content')
<h2 class="mb-4">Добавить клиента</h2>

<form action="{{ route('crm1.customers.store') }}" method="POST" class="shadow-sm p-4 bg-white rounded">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label fw-semibold">Имя</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label fw-semibold">Телефон (только цифры, 11 символов)</label>
        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" 
               class="form-control @error('phone') is-invalid @enderror"
               pattern="\d{11}" 
               title="Пожалуйста, введите ровно 11 цифр (без пробелов и других символов)"
               required>
        @error('phone')
            <div class="invalid-feedback">
                @if($message == 'validation.digits')
                    Телефон должен содержать ровно 11 цифр
                @elseif($message == 'validation.numeric')
                    Телефон должен содержать только цифры
                @else
                    {{ $message }}
                @endif
            </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary px-5 fw-semibold rounded-pill">Сохранить</button>
    <a href="{{ route('crm1.customers.index') }}" class="btn btn-secondary ms-2 rounded-pill">Отмена</a>
</form>

@endsection