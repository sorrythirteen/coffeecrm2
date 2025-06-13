@extends('layouts.app')

@section('title', 'Страница не найдена')

@section('content')
<div class="text-center py-5">
    <h1 class="display-1 text-danger">404</h1>
    <h2 class="mb-3">Упс! Страница не найдена</h2>
    <p class="mb-4">Запрошенная вами страница не существует, была удалена или временно недоступна.</p>
    <a href="{{ route('crm2.dashboard') }}" class="btn btn-primary rounded-pill px-4 py-2">
        Вернуться на главную
    </a>
</div>
@endsection
