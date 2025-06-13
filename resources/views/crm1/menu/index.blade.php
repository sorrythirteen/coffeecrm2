@extends('layouts.app')

@section('title', 'Меню CRM 1')

@section('content')
<h2 class="mb-4">Меню</h2>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <form action="{{ route('crm1.menu.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
        <input 
            type="search" 
            name="search" 
            value="{{ request('search') }}" 
            class="form-control shadow-sm rounded-pill border-primary" 
            placeholder="Поиск по меню..."
            aria-label="Поиск по меню"
        />
        <button type="submit" class="btn btn-primary ms-2 shadow-sm rounded-pill px-4 fw-semibold">
            Искать
        </button>
    </form>

    <div class="d-flex gap-2">
        <a href="{{ route('crm1.dashboard') }}" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-pill">
            <i class="bi bi-arrow-left-circle me-1"></i> Дашборд
        </a>
        <a href="{{ route('crm1.menu.create') }}" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-pill">
            Добавить позицию
        </a>
    </div>
</div>

@if($menuItems->count())
<table class="table table-hover shadow-sm rounded overflow-hidden">
  <thead class="table-primary text-primary fw-semibold">
    <tr>
      <th>Название</th>
      <th>Рецепт</th>
      <th>Цена</th>
      <th class="text-center">Действия</th>
    </tr>
  </thead>
  <tbody>
    @foreach($menuItems as $item)
    <tr class="align-middle">
      <td>{{ $item->name }}</td>
      <td>
        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#recipeModal{{ $item->id }}">
          Посмотреть
        </button>

        <!-- Модальное окно -->
        <div class="modal fade" id="recipeModal{{ $item->id }}" tabindex="-1" aria-labelledby="recipeModalLabel{{ $item->id }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="recipeModalLabel{{ $item->id }}">Рецепт: {{ $item->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
              </div>
              <div class="modal-body">
                {{ $item->description ?? 'Описание не указано.' }}
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
              </div>
            </div>
          </div>
        </div>
      </td>
      <td>{{ number_format($item->price, 2, ',', ' ') }} ₽</td>
      <td class="text-center" style="white-space: nowrap;">
        <a href="{{ route('crm1.menu.show', $item) }}" class="btn btn-sm btn-info me-1 shadow-sm rounded-pill" title="Просмотр">
          <i class="bi bi-eye"></i> Просмотр
        </a>
        <a href="{{ route('crm1.menu.edit', $item) }}" class="btn btn-sm btn-warning text-white me-1 shadow-sm rounded-pill" title="Редактировать">
          <i class="bi bi-pencil"></i> Редактировать
        </a>
        <form action="{{ route('crm1.menu.destroy', $item) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Удалить позицию меню?')">
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

{{ $menuItems->withQueryString()->links() }}

@else
<div class="alert alert-warning shadow-sm" role="alert">
  Позиции меню не найдены.
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
  .btn-secondary {
    background-color: #7f8c8d;
    border-color: #7f8c8d;
    color: #fff;
  }
  .btn-secondary:hover, .btn-secondary:focus {
    background-color: #626e70;
    border-color: #626e70;
    color: #fff;
    box-shadow: 0 6px 15px rgb(98 110 112 / 0.35);
    transform: translateY(-3px);
  }
</style>
@endpush

@endsection
