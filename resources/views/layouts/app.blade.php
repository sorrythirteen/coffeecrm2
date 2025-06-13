<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Coffee CRM')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f2f5;
      color: #2e3a59;
      padding-top: 70px;
      font-size: 16px;
      line-height: 1.5;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    nav.navbar {
      background-color:rgb(0, 0, 0);
      box-shadow: 0 4px 10px rgb(0 0 0 / 0.6);
      border-radius: 0;
      transition: background-color 0.25s ease;
      border-bottom: 2px solid #1f2a40;
    }
    nav.navbar:hover {
      background-color: #1f2a40;
      box-shadow: 0 6px 15px rgb(0 0 0 / 0.2);
    }
    nav .navbar-brand {
      color: #ecf0f1;
      font-weight: 600;
      font-size: 1.6rem;
      letter-spacing: 0.05em;
      user-select: none;
      transition: color 0.3s ease;
      text-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }
    nav .navbar-brand:hover {
      color: #3498db;
      text-decoration: none;
      text-shadow: 0 0 8px #3498db;
    }
    nav .nav-link {
      color: #bdc3c7;
      font-weight: 500;
      border-radius: 8px;
      padding: 10px 16px;
      transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
      margin: 0 8px;
      position: relative;
    }
    nav .nav-link::after {
      content: '';
      position: absolute;
      bottom: 6px;
      left: 50%;
      transform: translateX(-50%);
      width: 0;
      height: 3px;
      background-color: #3498db;
      border-radius: 2px;
      transition: width 0.3s ease;
    }
    nav .nav-link:hover::after, nav .nav-link.active::after {
      width: 60%;
    }
    nav .nav-link:hover, nav .nav-link.active {
      background-color: #34495e;
      color: #ecf0f1 !important;
      transform: translateY(-2px);
      box-shadow: 0 8px 18px rgb(0 0 0 / 0.18);
    }

    .container {
      max-width: 1140px;
    }

    .alert-success {
      background-color: #d6eaf8;
      border: 1px solid #85c1e9;
      color: #21618c;
      font-weight: 600;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgb(33 97 140 / 0.2);
    }

    .btn {
      border-radius: 10px;
      font-weight: 600;
      box-shadow: 0 3px 8px rgb(0 0 0 / 0.08);
      transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
    }
    .btn-primary {
      background-color: #2980b9;
      border-color: #2980b9;
      color: #fff;
    }
    .btn-primary:hover {
      background-color: #1f618d;
      border-color: #1f618d;
      box-shadow: 0 6px 15px rgb(31 97 141 / 0.35);
      transform: translateY(-3px);
      color: #fff;
    }

    .footer {
      padding: 18px 0;
      text-align: center;
      color: #95a5a6;
      font-size: 0.9rem;
      user-select: none;
      margin-top: 60px;
    }

    .card {
      border-radius: 14px;
      transition: box-shadow 0.3s ease, transform 0.2s ease;
      box-shadow: 0 2px 6px rgb(0 0 0 / 0.07);
    }
    .card:hover {
      box-shadow: 0 10px 20px rgb(0 0 0 / 0.12);
      transform: translateY(-4px);
    }

    ::-webkit-scrollbar {
      width: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #ecf0f1;
      border-radius: 8px;
    }
    ::-webkit-scrollbar-thumb {
      background: #34495e;
      border-radius: 8px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #2c3e50;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">CoffeeCRM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    @if(isset($crmNumber))
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
          <a href="{{ route('crm'.$crmNumber.'.dashboard') }}" class="nav-link {{ request()->routeIs('crm'.$crmNumber.'.dashboard') ? 'active' : '' }}">Главная</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('crm.change') }}" class="btn btn-sm btn-outline-light ms-2" style="padding: 6px 12px; font-size: 0.875rem;">
            Сменить систему
          </a>
        </li>
      </ul>
    </div>
    @endif
  </div>
</nav>

<div class="container mt-4">
  @if(session('success'))
    <div class="alert alert-success shadow-sm" role="alert">
      {{ session('success') }}
    </div>
  @endif

  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
