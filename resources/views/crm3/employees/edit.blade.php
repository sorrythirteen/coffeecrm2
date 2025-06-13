@extends('layouts.app')

@section('title', 'Редактировать сотрудника')

@section('content')
<h2>Редактировать сотрудника</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('crm3.employees.update', $employee) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $employee->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Телефон</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employee->email) }}">
    </div>

    <div class="mb-3">
        <label for="position" class="form-label">Должность</label>
        <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $employee->position) }}">
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="{{ route('crm3.employees.index') }}" class="btn btn-secondary">Отмена</a>
</form>
@endsection
