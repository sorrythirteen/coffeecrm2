@extends('layouts.app')

@section('title', 'Просмотр записи рабочего времени')

@section('content')
<h2 class="mb-4">Просмотр записи рабочего времени</h2>

<a href="{{ route('crm3.workhours.index') }}" class="btn btn-secondary mb-4 rounded-pill px-4 py-2">
    ← Назад к списку
</a>

<div class="card shadow-sm p-4">
    <p><strong>Сотрудник:</strong> {{ $workhour->employee ? $workhour->employee->name : '—' }}</p>
    <p><strong>Дата:</strong> {{ $workhour->work_date ? \Carbon\Carbon::parse($workhour->work_date)->format('d.m.Y') : '—' }}</p>
</div>


<a href="{{ route('crm3.workhours.edit', $workhour) }}" class="btn btn-warning mt-4 rounded-pill px-4 py-2 text-white">
    Редактировать
</a>
@endsection
