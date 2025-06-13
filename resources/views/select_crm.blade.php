@extends('layouts.app')

@section('title', 'Выбор CRM-системы')

@section('content')
<div class="container my-5" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 960px;">

  <form method="POST" action="{{ route('select.crm.submit') }}">
    @csrf

    <div class="d-flex justify-content-center gap-4 mb-5" style="flex-wrap: nowrap;">
      <!-- CRM 1 -->
      <label class="subscription-card p-4 rounded shadow-sm flex-fill"
             style="max-width: 300px; cursor: pointer; border: 2px solid transparent; background-color: #f8fafd;">
        <input type="radio" name="crm" value="1" required class="d-none" />
        <div class="card-content text-center">
          <h3 class="mb-3 fw-bold" style="color:rgb(0, 0, 0);">CRM 1</h3>
          <p class="mb-3 text-muted" style="font-size: 0.9rem;">
            Всё необходимое для старта: управление клиентами, заказами и продуктами. Отлично подходит для небольших кофеен и быстрых операций.
          </p>
        </div>
      </label>

      <!-- CRM 2 -->
      <label class="subscription-card p-4 rounded shadow-sm flex-fill"
             style="max-width: 300px; cursor: pointer; border: 2px solid transparent; background-color: #f8fafd;">
        <input type="radio" name="crm" value="2" required class="d-none" />
        <div class="card-content text-center">
          <h3 class="mb-3 fw-bold" style="color:rgb(0, 0, 0);">CRM 2</h3>
          <p class="mb-3 text-muted" style="font-size: 0.9rem;">
            Включает все возможности CRM 1 плюс расширенный контроль сотрудников и смен.
            Подходит для кафе с персоналом и необходимостью контроля работы команды.
          </p>
        </div>
      </label>

      <!-- CRM 3 -->
      <label class="subscription-card p-4 rounded shadow-sm flex-fill"
             style="max-width: 300px; cursor: pointer; border: 2px solid transparent; background-color: #f8fafd;">
        <input type="radio" name="crm" value="3" required class="d-none" />
        <div class="card-content text-center">
          <h3 class="mb-3 fw-bold" style="color:rgb(0, 0, 0);">CRM 3</h3>
          <p class="mb-3 text-muted" style="font-size: 0.9rem;">
            Включает все функции CRM 2 плюс отзывы клиентов и систему лояльности.
            Лучший выбор для роста клиентской базы и увеличения повторных продаж.
          </p>
        </div>
      </label>
    </div>

    <div class="table-responsive" style="max-width: 720px; margin: 0 auto 40px auto;">
      <table class="table table-bordered text-center align-middle" style="user-select:none;">
        <thead style="background-color: #e9f0fb;">
          <tr>
            <th style="width: 50%;"></th>
            <th style="width: 16%;">CRM 1</th>
            <th style="width: 16%;">CRM 2</th>
            <th style="width: 16%;">CRM 3</th>
          </tr>
        </thead>
        <tbody>
          @php
            function iconCheck() {
              return '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0L11.03 8.07a.75.75 0 1 0-1.06-1.06L7.5 9.44 6.53 8.47a.75.75 0 1 0-1.06 1.06l1.5 1.5z"/>
              </svg>';
            }
            function iconCross() {
              return '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.646 4.646a.5.5 0 0 0 0 .708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8 11.354 5.354a.5.5 0 1 0-.708-.708L8 7.293 5.354 4.646a.5.5 0 0 0-.708 0z"/>
              </svg>';
            }
          @endphp
          <tr>
            <td class="text-start">Управление клиентами</td>
            <td>{!! iconCheck() !!}</td>
            <td>{!! iconCheck() !!}</td>
            <td>{!! iconCheck() !!}</td>
          </tr>
          <tr>
            <td class="text-start">Управление заказами</td>
            <td>{!! iconCheck() !!}</td>
            <td>{!! iconCheck() !!}</td>
            <td>{!! iconCheck() !!}</td>
          </tr>
          <tr>
            <td class="text-start">Управление меню</td>
            <td>{!! iconCheck() !!}</td>
            <td>{!! iconCheck() !!}</td>
            <td>{!! iconCheck() !!}</td>
          </tr>
          <tr>
            <td class="text-start">Управление сотрудниками и сменами</td>
            <td>{!! iconCross() !!}</td>
            <td>{!! iconCheck() !!}</td>
            <td>{!! iconCheck() !!}</td>
          </tr>
          <tr>
            <td class="text-start">Отзывы клиентов</td>
            <td>{!! iconCross() !!}</td>
            <td>{!! iconCross() !!}</td>
            <td>{!! iconCheck() !!}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="mt-3 text-center">
      <button type="submit" class="btn btn-primary btn-lg px-5" style="border-radius: 30px;">
        Выбрать версию
      </button>
    </div>

    <p class="attention-text text-center">
      Внимание: выбор версии CRM производится один раз и изменить его в будущем нельзя.
    </p>
  </form>
</div>

<style>
  /* Карточки */
  .subscription-card {
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    user-select: none;
    min-width: 280px;
    max-width: 300px;
  }

  /* Лёгкая подсветка при наведении */
  .subscription-card:hover {
    background-color: #e4f0fc;
  }

  /* Подсветка при выборе (нажатии) */
  input[type="radio"]:checked + .card-content {
    background-color: #d0e4fb;
    border-radius: 12px;
  }

  /* Скругление таблицы */
  .table {
    border-collapse: separate !important;
    border-spacing: 0;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  .table thead tr th:first-child {
    border-top-left-radius: 12px;
  }

  .table thead tr th:last-child {
    border-top-right-radius: 12px;
  }

  .table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
  }

  .table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
  }

  /*  предупреждение */
  .attention-text {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2c3e50;
    background-color: #f0f8ff;
    padding: 12px 20px;
    border-radius: 12px;
    box-shadow: 0 0 8px rgba(44, 62, 80, 0.3);
    user-select: none;
    max-width: 600px;
    margin: 30px auto 0 auto;
  }
</style>

@endsection
