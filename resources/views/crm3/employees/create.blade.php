@extends('layouts.app')

@section('title', 'Добавить сотрудника CRM 2')

@section('content')
<h2 class="mb-4">Добавить сотрудника</h2>

<form action="{{ route('crm3.employees.store') }}" method="POST" class="w-100" style="max-width: 600px;">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label fw-semibold">Имя</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
        @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
        @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label fw-semibold">Телефон</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control" required>
        @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="position" class="form-label fw-semibold">Должность</label>
        <input type="text" id="position" name="position" value="{{ old('position') }}" class="form-control">
        @error('position')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">Добавить</button>
    <a href="{{ route('crm3.employees.index') }}" class="btn btn-secondary rounded-pill px-4 py-2 ms-2">Отмена</a>
</form>
@endsection
