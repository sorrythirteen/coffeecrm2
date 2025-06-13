@extends('layouts.app')

@section('title', 'Дашборд')

@section('content')
<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Клиенты</h5>
                <p class="card-text">Управление клиентами и их информацией.</p>
                <a href="{{ route('crm3.customers.index') }}" class="btn btn-primary w-100">Перейти</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Сотрудники</h5>
                <p class="card-text">Управление персоналом.</p>
                <a href="{{ route('crm3.employees.index') }}" class="btn btn-primary w-100">Перейти</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Меню</h5>
                <p class="card-text">Просмотр и управление ассортиментом.</p>
                <a href="{{ route('crm3.menu.index') }}" class="btn btn-primary w-100">Перейти</a>
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Заказы</h5>
                <p class="card-text">Учёт и обработка заказов.</p>
                <a href="{{ route('crm3.orders.index') }}" class="btn btn-primary w-100">Перейти</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Рабочее время</h5>
                <p class="card-text">Учёт отработанных часов сотрудников.</p>
                <a href="{{ route('crm3.workhours.index') }}" class="btn btn-primary w-100">Перейти</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Отзывы</h5>
                <p class="card-text">Теплые отзывы покупателей.</p>
                <a href="{{ route('crm3.reviews.index') }}" class="btn btn-primary w-100">Перейти</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h5 class="card-title mb-3 text-center">Календарь</h5>
            <div id="calendar" class="d-flex flex-wrap justify-content-center"></div>
        </div>
    </div>
    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
        <div class="card shadow-sm p-4 w-100 text-center">
            <h5 class="card-title mb-3">Текущее время</h5>
            <div id="moscow-time" style="font-size: 2rem; font-weight: 700; color: #2980b9;"></div>
        </div>
    </div>
</div>

<script>
  function renderCalendar() {
    const calendarEl = document.getElementById('calendar');
    calendarEl.innerHTML = '';

    const now = new Date();
    const offset = 3 * 60; 
    const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
    const moscowDate = new Date(utc + (offset * 60000));

    const year = moscowDate.getFullYear();
    const month = moscowDate.getMonth();

    const monthNames = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];
    const dayNames = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];

    const header = document.createElement('div');
    header.style.width = '100%';
    header.style.textAlign = 'center';
    header.style.fontWeight = '600';
    header.style.fontSize = '1.2rem';
    header.style.marginBottom = '10px';
    header.textContent = `${monthNames[month]} ${year}`;
    calendarEl.appendChild(header);

    dayNames.forEach(day => {
      const dayEl = document.createElement('div');
      dayEl.textContent = day;
      dayEl.style.width = '40px';
      dayEl.style.textAlign = 'center';
      dayEl.style.fontWeight = '600';
      dayEl.style.color = '#2980b9';
      dayEl.style.marginBottom = '5px';
      calendarEl.appendChild(dayEl);
    });

    const firstDay = new Date(year, month, 1);
    let startDay = firstDay.getDay() - 1;
    if (startDay < 0) startDay = 6;

    const daysInMonth = new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < startDay; i++) {
      const emptyCell = document.createElement('div');
      emptyCell.style.width = '40px';
      emptyCell.style.height = '30px';
      calendarEl.appendChild(emptyCell);
    }

    for (let day = 1; day <= daysInMonth; day++) {
      const dayCell = document.createElement('div');
      dayCell.textContent = day;
      dayCell.style.width = '40px';
      dayCell.style.height = '30px';
      dayCell.style.textAlign = 'center';
      dayCell.style.lineHeight = '30px';
      dayCell.style.borderRadius = '6px';
      dayCell.style.marginBottom = '5px';
      dayCell.style.cursor = 'default';

      if (day === moscowDate.getDate()) {
        dayCell.style.backgroundColor = '#2980b9';
        dayCell.style.color = '#fff';
        dayCell.style.fontWeight = '700';
        dayCell.style.boxShadow = '0 0 8px rgba(41,128,185,0.6)';
      }
      calendarEl.appendChild(dayCell);
    }
  }

  function updateMoscowTime() {
    const now = new Date();
    const offset = 3 * 60;
    const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
    const moscowDate = new Date(utc + (offset * 60000));

    const timeStr = moscowDate.toLocaleTimeString('ru-RU', {hour12: false});
    document.getElementById('moscow-time').textContent = timeStr;
  }

  document.addEventListener('DOMContentLoaded', () => {
    renderCalendar();
    updateMoscowTime();
    setInterval(updateMoscowTime, 1000);
  });
</script>

<style>
  #calendar {
    display: grid;
    grid-template-columns: repeat(7, 40px);
    justify-content: center;
    gap: 6px;
    user-select: none;
  }
</style>
@endsection
