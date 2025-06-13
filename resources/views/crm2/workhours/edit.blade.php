@extends('layouts.app')

@section('title', 'Редактировать запись рабочего времени')

@section('content')
<h2 class="mb-4">Редактировать запись рабочего времени</h2>

<a href="{{ route('crm2.workhours.index') }}" class="btn btn-secondary mb-4 rounded-pill px-4 py-2">
    ← Назад к списку
</a>

<form method="POST" action="{{ route('crm2.workhours.update', $workhour) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="employee_id" class="form-label">Сотрудник</label>
        <select id="employee_id" name="employee_id" class="form-select @error('employee_id') is-invalid @enderror" required>
            <option value="" disabled>Выберите сотрудника</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" 
                    {{ old('employee_id', $workhour->employee_id) == $employee->id ? 'selected' : '' }}>
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
        <input type="date" id="work_date" name="work_date" 
               class="form-control @error('work_date') is-invalid @enderror" 
               value="{{ old('work_date', $workhour->work_date instanceof \Carbon\Carbon ? $workhour->work_date->format('Y-m-d') : $workhour->work_date) }}" required>
        @error('work_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="start_time" class="form-label">Время начала</label>
        <input type="time" id="start_time" name="start_time" 
               class="form-control @error('start_time') is-invalid @enderror" 
               value="{{ old('start_time', $workhour->start_time) }}" required>
        @error('start_time')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="end_time" class="form-label">Время окончания</label>
        <input type="time" id="end_time" name="end_time" 
               class="form-control @error('end_time') is-invalid @enderror" 
               value="{{ old('end_time', $workhour->end_time) }}" required>
        @error('end_time')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-warning text-white rounded-pill px-4 py-2">Сохранить</button>
</form>
@endsection