@extends('layouts.app')

@section('title', 'Редактирование отзыва')

@section('content')
<h2 class="mb-4">Редактировать отзыв</h2>

<form action="{{ route('crm3.reviews.update', $review) }}" method="POST" class="shadow-sm p-4 bg-white rounded">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="customer_id" class="form-label fw-semibold">Клиент</label>
        <select name="customer_id" id="customer_id" class="form-select @error('customer_id') is-invalid @enderror" required>
            <option value="">Выберите клиента</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" @selected(old('customer_id', $review->customer_id) == $customer->id)>
                    {{ $customer->name }} ({{ $customer->email }})
                </option>
            @endforeach
        </select>
        @error('customer_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="rating" class="form-label fw-semibold">Оценка</label>
        <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror" required>
            <option value="">Выберите оценку</option>
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" @selected(old('rating', $review->rating) == $i)>{{ $i }} звезд</option>
            @endfor
        </select>
        @error('rating')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="comment" class="form-label fw-semibold">Комментарий</label>
        <textarea name="comment" id="comment" rows="5" class="form-control @error('comment') is-invalid @enderror" required>{{ old('comment', $review->comment) }}</textarea>
        @error('comment')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="status" class="form-label fw-semibold">Статус</label>
        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
            <option value="pending" @selected(old('status', $review->status) == 'pending')>На рассмотрении</option>
            <option value="approved" @selected(old('status', $review->status) == 'approved')>Одобрен</option>
            <option value="rejected" @selected(old('status', $review->status) == 'rejected')>Отклонен</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary px-5 fw-semibold rounded-pill">Сохранить</button>
    <a href="{{ route('crm3.reviews.index') }}" class="btn btn-secondary ms-2 rounded-pill">Отмена</a>
</form>

@endsection