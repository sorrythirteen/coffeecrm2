@extends('layouts.app')

@section('title', 'Просмотр сотрудника CRM 2')

@section('content')
<h2 class="mb-4">Сотрудник: {{ $employee->name }}</h2>

<ul class="list-group mb-4">
    <li class="list-group-item"><strong>Email:</strong> {{ $employee->email }}</li>
    <li class="list-group-item"><strong>Телефон:</strong> {{ $employee->phone }}</li>
    <li class="list-group-item"><strong>Должность:</strong> {{ $employee->position ?? '—' }}</li>
</ul>

<a href="{{ route('crm3.employees.index') }}" class="btn btn-secondary rounded-pill px-4">Назад к списку</a>
@endsection
