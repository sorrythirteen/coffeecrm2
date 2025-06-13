@extends('layouts.app')

@section('title', 'Клиенты')

@section('content')
<h2 class="mb-4">Клиенты</h2>

<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('crm3.dashboard') }}" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-pill me-3">
        <i class="bi bi-speedometer2"></i> Дашборд
    </a>

    <form action="{{ route('crm3.customers.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
        <input 
            type="search" 
            name="search" 
            value="{{ request('search') }}" 
            class="form-control shadow-sm rounded-pill border-primary" 
            placeholder="Поиск клиентов..."
            aria-label="Поиск клиентов"
        />
        <button type="submit" class="btn btn-primary ms-2 shadow-sm rounded-pill px-4 fw-semibold">
            Искать
        </button>
    </form>

    <a href="{{ route('crm3.customers.create') }}" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-pill">
        Добавить клиента
    </a>
</div>

@if($customers->count())
<table class="table table-hover shadow-sm rounded overflow-hidden">
  <thead class="table-primary text-primary fw-semibold">
    <tr>
      <th>Имя</th>
      <th>Email</th>
      <th>Телефон</th>
      <th class="text-center">Действия</th>
    </tr>
  </thead>
  <tbody>
    @foreach($customers as $customer)
    <tr class="align-middle">
      <td>{{ $customer->name }}</td>
      <td>{{ $customer->email }}</td>
      <td>{{ $customer->phone }}</td>
      <td class="text-center" style="white-space: nowrap;">
        <a href="{{ route('crm3.customers.show', $customer) }}" class="btn btn-sm btn-info me-1 shadow-sm rounded-pill" title="Просмотр">
          <i class="bi bi-eye"></i> Просмотр
        </a>
        <a href="{{ route('crm3.customers.edit', $customer) }}" class="btn btn-sm btn-warning text-white me-1 shadow-sm rounded-pill" title="Редактировать">
          <i class="bi bi-pencil"></i> Редактировать
        </a>
        <form action="{{ route('crm3.customers.destroy', $customer) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Удалить клиента?')">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-danger shadow-sm rounded-pill" title="Удалить">
            <i class="bi bi-trash"></i> Удалить
          </button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $customers->withQueryString()->links() }}

@else
<div class="alert alert-warning shadow-sm" role="alert">
  Клиенты не найдены.
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
