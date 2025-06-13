@extends('layouts.app')

@section('title', 'Редактировать товар меню')

@section('content')
<h2 class="mb-4">Редактировать товар меню</h2>

<form action="{{ route('crm2.menu.update', $menu) }}" method="POST" class="shadow-sm p-4 rounded bg-white">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label fw-semibold">Название</label>
        <input type="text" name="name" id="name" value="{{ old('name', $menu->name) }}" class="form-control shadow-sm @error('name') is-invalid @enderror" required>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label fw-semibold">Описание</label>
        <textarea name="description" id="description" rows="3" class="form-control shadow-sm @error('description') is-invalid @enderror">{{ old('description', $menu->description) }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="price" class="form-label fw-semibold">Цена (в рублях)</label>
        <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price', $menu->price) }}" class="form-control shadow-sm @error('price') is-invalid @enderror" required>
        @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary shadow-sm rounded-pill px-4 py-2 fw-semibold">Сохранить</button>
    <a href="{{ route('crm2.menu.index') }}" class="btn btn-secondary shadow-sm rounded-pill px-4 py-2 ms-2">Отмена</a>
</form>
@endsection
