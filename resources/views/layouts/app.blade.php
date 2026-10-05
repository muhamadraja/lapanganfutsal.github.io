<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UIN RF FUTSAL Reservation') }}</title>

    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body { background: #f5f7fb; font-family: Nunito, sans-serif; }
        .navbar-brand { font-weight: 800; }
        .brand-icon { color: #16a34a; }
        .card { border: 0; border-radius: 16px; }
        .btn { border-radius: 10px; }
        .table { vertical-align: middle; }
        .page-title { font-weight: 800; }
        .hero-mini { background: linear-gradient(135deg,#0f766e,#16a34a); color:white; border-radius:20px; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fa-solid fa-shuttlecock brand-icon"></i> UIN RF FUTSAL
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('lapangan.index') }}"><i class="fa-solid fa-table-tennis-paddle-ball"></i> Kelola Lapangan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.reservasi') }}"><i class="fa-solid fa-calendar-check"></i> Reservasi</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('lapangan.list') }}"><i class="fa-solid fa-table-tennis-paddle-ball"></i> Lapangan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reservasi.saya') }}"><i class="fa-solid fa-calendar-days"></i> Reservasi Saya</a></li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="btn btn-success text-white ms-lg-2" href="{{ route('register') }}">Daftar</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-user"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('home') }}">Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
    @if(session('success'))
        <div class="container"><div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div></div>
    @endif
    @if(session('error'))
        <div class="container"><div class="alert alert-danger alert-dismissible fade show shadow-sm">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div></div>
    @endif
    @yield('content')
</main>

<footer class="bg-dark text-white text-center py-4 mt-5">
    <div class="container">
        <strong>UIN RF FUTSAL Reservation</strong>
        <div class="small text-white-50 mt-1">Sistem reservasi lapangan futsal UIN Raden Fatah</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
