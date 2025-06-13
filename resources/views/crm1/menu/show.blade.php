@extends('layouts.app')

@section('title', 'Просмотр товара меню')

@section('content')
<h2 class="mb-4">Просмотр товара меню</h2>

<div class="card shadow-sm p-4 rounded bg-white">
    <h4>{{ $menu->name }}</h4>
    <p><strong>Описание:</strong> {{ $menu->description ?? 'Нет описания' }}</p>
    <p><strong>Цена:</strong> {{ number_format($menu->price, 2, ',', ' ') }} ₽</p>
</div>

<a href="{{ route('crm1.menu.index') }}" class="btn btn-secondary shadow-sm rounded-pill px-4 py-2 mt-4">Назад к списку</a>
@endsection
