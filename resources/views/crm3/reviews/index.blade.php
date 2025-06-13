@extends('layouts.app')

@section('title', 'Отзывы')

@section('content')
<h2 class="mb-4">Отзывы клиентов</h2>

<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('crm3.dashboard') }}" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-pill me-3">
        <i class="bi bi-speedometer2"></i> Дашборд
    </a>

    <form action="{{ route('crm3.reviews.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
        <input 
            type="search" 
            name="search" 
            value="{{ request('search') }}" 
            class="form-control shadow-sm rounded-pill border-primary" 
            placeholder="Поиск отзывов..."
            aria-label="Поиск отзывов"
        />
        <button type="submit" class="btn btn-primary ms-2 shadow-sm rounded-pill px-4 fw-semibold">
            Искать
        </button>
    </form>

    <a href="{{ route('crm3.reviews.create') }}" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-pill">
        Добавить отзыв
    </a>
</div>

@if($reviews->count())
<table class="table table-hover shadow-sm rounded overflow-hidden">
  <thead class="table-primary text-primary fw-semibold">
    <tr>
      <th>Клиент</th>
      <th>Оценка</th>
      <th>Комментарий</th>
      <th>Статус</th>
      <th class="text-center">Действия</th>
    </tr>
  </thead>
  <tbody>
    @foreach($reviews as $review)
    <tr class="align-middle">
      <td>{{ $review->customer->name }}</td>
      <td>
        {{ str_repeat('⭐', $review->rating) }}
      </td>
      <td>{{ Str::limit($review->comment, 50) }}</td>
      <td>
        @php
          $statusMap = [
            'pending' => ['text' => 'На рассмотрении', 'class' => 'border-secondary text-secondary'],
            'approved' => ['text' => 'Одобрен', 'class' => 'border-success text-success'],
            'rejected' => ['text' => 'Отклонен', 'class' => 'border-danger text-danger']
          ];
          $statusInfo = $statusMap[$review->status] ?? $statusMap['pending'];
        @endphp
        <span class="badge rounded-pill bg-light {{ $statusInfo['class'] }} border border-2 px-3 py-1">
          {{ $statusInfo['text'] }}
        </span>
      </td>
      <td class="text-center" style="white-space: nowrap;">
        <a href="{{ route('crm3.reviews.show', $review) }}" class="btn btn-sm btn-info me-1 shadow-sm rounded-pill" title="Просмотр">
          <i class="bi bi-eye"></i> Просмотр
        </a>
        <a href="{{ route('crm3.reviews.edit', $review) }}" class="btn btn-sm btn-warning text-white me-1 shadow-sm rounded-pill" title="Редактировать">
          <i class="bi bi-pencil"></i> Редактировать
        </a>
        <form action="{{ route('crm3.reviews.destroy', $review) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Удалить отзыв?')">
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

{{ $reviews->withQueryString()->links() }}

@else
<div class="alert alert-warning shadow-sm" role="alert">
  Отзывы не найдены.
</div>
@endif

@endsection
