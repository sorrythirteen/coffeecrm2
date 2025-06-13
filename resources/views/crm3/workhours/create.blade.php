@extends('layouts.app')

@section('title', 'Добавление рабочего время')

@section('content')
<h2 class="mb-4">Добавить запись рабочего времени</h2>

<a href="{{ route('crm3.workhours.index') }}" class="btn btn-secondary mb-4">
    ← Вернуться к списку
</a>

<form action="{{ route('crm3.workhours.store') }}" method="POST" lang="ru">
    @csrf

    <div class="mb-3">
        <label for="employee_id" class="form-label">Сотрудник</label>
        <select name="employee_id" id="employee_id" class="form-select @error('employee_id') is-invalid @enderror" required>
            <option value="">Выберите сотрудника</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" @selected(old('employee_id') == $employee->id)>
                    {{ $employee->name }}
                </option>
            @endforeach
        </select>
        @error('employee_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="work_date" class="form-label">Дата</label>
        <input type="date" name="work_date" id="work_date" class="form-control @error('work_date') is-invalid @enderror" value="{{ old('work_date') }}" required>
        @error('work_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="start_time" class="form-label">Время начала</label>
        <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time') }}" required step="60">
        @error('start_time')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="end_time" class="form-label">Время окончания</label>
        <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}" required step="60">
        @error('end_time')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection
