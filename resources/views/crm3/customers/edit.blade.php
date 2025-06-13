@extends('layouts.app')

@section('title', 'Редактирование клиента')

@section('content')
<h2>Редактировать клиента</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('crm3.customers.update', $customer) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Телефон</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}">
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="{{ route('crm2.customers.index') }}" class="btn btn-secondary">Отмена</a>
</form>
@endsection
