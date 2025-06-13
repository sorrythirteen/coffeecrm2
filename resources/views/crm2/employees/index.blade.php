@extends('layouts.app')

@section('title', 'Сотрудники')

@section('content')
<h2 class="mb-4">Сотрудники</h2>

<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('crm2.dashboard') }}" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-pill me-3">
        <i class="bi bi-speedometer2"></i> Дашборд
    </a>

    <form action="{{ route('crm2.employees.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
        <input 
            type="search" 
            name="search" 
            value="{{ request('search') }}" 
            class="form-control shadow-sm rounded-pill border-primary" 
            placeholder="Поиск сотрудников..."
            aria-label="Поиск сотрудников"
        />
        <button type="submit" class="btn btn-primary ms-2 shadow-sm rounded-pill px-4 fw-semibold">
            Искать
        </button>
    </form>

    <a href="{{ route('crm2.employees.create') }}" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-pill">
        Добавить сотрудника
    </a>
</div>

@if($employees->count())
<table class="table table-hover shadow-sm rounded overflow-hidden">
  <thead class="table-primary text-primary fw-semibold">
    <tr>
      <th>Имя</th>
      <th>Email</th>
      <th>Телефон</th>
      <th>Должность</th>
      <th class="text-center">Действия</th>
    </tr>
  </thead>
  <tbody>
    @foreach($employees as $employee)
    <tr class="align-middle">
      <td>{{ $employee->name }}</td>
      <td>{{ $employee->email }}</td>
      <td>{{ $employee->phone }}</td>
      <td>{{ $employee->position ?? '—' }}</td>
      <td class="text-center" style="white-space: nowrap;">
        <a href="{{ route('crm2.employees.show', $employee) }}" class="btn btn-sm btn-info me-1 shadow-sm rounded-pill" title="Просмотр">
          <i class="bi bi-eye"></i> Просмотр
        </a>
        <a href="{{ route('crm2.employees.edit', $employee) }}" class="btn btn-sm btn-warning text-white me-1 shadow-sm rounded-pill" title="Редактировать">
          <i class="bi bi-pencil"></i> Редактировать
        </a>
        <button type="button" class="btn btn-sm btn-danger shadow-sm rounded-pill" 
                title="Удалить" data-bs-toggle="modal" 
                data-bs-target="#deleteModal-{{ $employee->id }}">
          <i class="bi bi-trash"></i> Удалить
        </button>
        
        <div class="modal fade" id="deleteModal-{{ $employee->id }}" tabindex="-1" 
             aria-labelledby="deleteModalLabel-{{ $employee->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $employee->id }}">Подтверждение удаления</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{ route('crm2.employees.destroy', $employee->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                  <p>Вы действительно хотите удалить сотрудника <strong>{{ $employee->name }}</strong>?</p>
                  <p>ID сотрудника: <strong class="text-danger">{{ $employee->id }}</strong></p>
                  <div class="mb-3">
                    <label for="deleteCode-{{ $employee->id }}" class="form-label">Код подтверждения</label>
                    <input type="text" class="form-control" 
                           id="deleteCode-{{ $employee->id }}" 
                           name="delete_code" required>
                    @if($errors->has('delete_code'))
                      <div class="invalid-feedback d-block">
                        {{ $errors->first('delete_code') }}
                      </div>
                    @endif
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                  <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Удалить
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $employees->withQueryString()->links() }}

@else
<div class="alert alert-warning shadow-sm" role="alert">
  Сотрудники не найдены.
</div>
@endif

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
<style>
  .btn-primary {
    background-color: #2980b9;
    border-color: #2980b9;
    color: #fff;
  }
  .btn-primary:hover, .btn-primary:focus {
    background-color: #1f618d;
    border-color: #1f618d;
    color: #fff;
    box-shadow: 0 6px 15px rgb(31 97 141 / 0.35);
    transform: translateY(-3px);
  }
  .btn-info {
    background-color: #3498db;
    border-color: #3498db;
    color: #fff;
  }
  .btn-info:hover, .btn-info:focus {
    background-color: #217dbb;
    border-color: #217dbb;
    color: #fff;
  }
  .btn-warning {
    background-color: #f39c12;
    border-color: #f39c12;
    color: #fff;
  }
  .btn-warning:hover, .btn-warning:focus {
    background-color: #d78f0b;
    border-color: #d78f0b;
    color: #fff;
  }
  .btn-danger {
    background-color: #c0392b;
    border-color: #c0392b;
    color: #fff;
  }
  .btn-danger:hover, .btn-danger:focus {
    background-color: #922b21;
    border-color: #922b21;
    color: #fff;
  }
</style>
@endpush

@endsection