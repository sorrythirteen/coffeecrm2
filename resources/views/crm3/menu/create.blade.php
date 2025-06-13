@extends('layouts.app')

@section('title', 'Добавление меню')

@section('content')
<h2 class="mb-4">Добавить товар в меню</h2>

<form action="{{ route('crm3.menu.store') }}" method="POST" class="shadow-sm p-4 rounded bg-white">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label fw-semibold">Название</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control shadow-sm @error('name') is-invalid @enderror" required>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label fw-semibold">Описание</label>
        <textarea name="description" id="description" rows="3" class="form-control shadow-sm @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="price" class="form-label fw-semibold">Цена (в рублях)</label>
        <input type="number" name="price" id="price" step="0.01" min="0" max="99999.99" 
               value="{{ old('price') }}" 
               class="form-control shadow-sm @error('price') is-invalid @enderror" 
               required
               oninput="validatePrice(this)">
        @error('price')
        <div class="invalid-feedback">
            @if($message == 'validation.max_digits')
                Цена должна быть не более 99999 рублей
            @elseif($message == 'validation.max')
                Максимальная цена - 99999.99
            @else
                {{ $message }}
            @endif
        </div>
        @enderror
        <small class="text-muted">Максимум 5 цифр до запятой (макс. 99999.99)</small>
    </div>

    <button type="submit" class="btn btn-primary shadow-sm rounded-pill px-4 py-2 fw-semibold">Добавить</button>
    <a href="{{ route('crm3.menu.index') }}" class="btn btn-secondary shadow-sm rounded-pill px-4 py-2 ms-2">Отмена</a>
</form>

<script>
function validatePrice(input) {
    // Получаем значение и разделяем на целую и дробную части
    let value = input.value;
    if (value.includes('.')) {
        let parts = value.split('.');
        if (parts[0].length > 5) {
            input.setCustomValidity('Целая часть должна содержать не более 5 цифр');
        } else {
            input.setCustomValidity('');
        }
    } else {
        if (value.length > 5) {
            input.setCustomValidity('Целая часть должна содержать не более 5 цифр');
        } else {
            input.setCustomValidity('');
        }
    }
}
</script>
@endsection