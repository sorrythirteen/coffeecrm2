@extends('layouts.app')

@section('title', 'Просмотр отзыва')

@section('content')
<h2 class="mb-4">Просмотр отзыва</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <h5 class="fw-semibold">Клиент:</h5>
                <p>{{ $review->customer->name }} ({{ $review->customer->email }})</p>
            </div>
            <div class="col-md-6">
                <h5 class="fw-semibold">Дата создания:</h5>
                <p>{{ $review->created_at->format('d.m.Y H:i') }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <h5 class="fw-semibold">Оценка:</h5>
                <div class="star-rating">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill text-warning' : '' }} fs-4"></i>
                    @endfor
                </div>
            </div>
            <div class="col-md-6">
                <h5 class="fw-semibold">Статус:</h5>
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
            </div>
        </div>

        <div class="mb-3">
            <h5 class="fw-semibold">Комментарий:</h5>
            <div class="p-3 bg-light rounded">
                {{ $review->comment }}
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('crm3.reviews.edit', $review) }}" class="btn btn-warning text-white me-2 rounded-pill px-4">
                <i class="bi bi-pencil"></i> Редактировать
            </a>
            <form action="{{ route('crm3.reviews.destroy', $review) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger rounded-pill px-4" onclick="return confirm('Удалить отзыв?')">
                    <i class="bi bi-trash"></i> Удалить
                </button>
            </form>
        </div>
    </div>
</div>

@endsection