<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UIN RF FUTSAL Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { font-family: system-ui, sans-serif; background:#f8fafc; }
        .hero { min-height: 78vh; display:flex; align-items:center; color:#fff;
            background: radial-gradient(circle at top right, #34d399, transparent 35%),
                        linear-gradient(135deg,#064e3b,#16a34a); }
        .glass { background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2); border-radius:22px; }
        .feature { border:0; border-radius:18px; height:100%; box-shadow:0 10px 30px rgba(15,23,42,.08); }
        .brand { font-weight:800; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand brand" href="/"><i class="fa-solid fa-shuttlecock text-success"></i> UIN RF FUTSAL</a>
        <div class="d-flex gap-2">
            @auth
                <a href="{{ route('home') }}" class="btn btn-outline-light">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
                <a href="{{ route('register') }}" class="btn btn-success">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span class="badge bg-light text-success mb-3 px-3 py-2">UIN Raden Fatah Palembang</span>
                <h1 class="display-4 fw-bold">Reservasi Lapangan futsal UIN RF</h1>
                <p class="lead mt-3 mb-4">Pesan lapangan  futsal dengan mudah, pilih tanggal dan jam bermain, lalu tunggu konfirmasi admin.</p>
                <div class="d-flex flex-wrap gap-3">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4"><i class="fa-solid fa-user-plus"></i> Daftar Sekarang</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                    @else
                        <a href="{{ route('lapangan.list') }}" class="btn btn-light btn-lg px-4"><i class="fa-solid fa-calendar-plus"></i> Pesan Lapangan</a>
                    @endguest
                </div>
            </div>
            <div class="col-lg-5">
                <div class="glass p-5 text-center">
                    <i class="fa-solid fa-table-tennis-paddle-ball fa-5x mb-4"></i>
                    <h3 class="fw-bold">Main Lebih Teratur</h3>
                    <p class="mb-0">Cek lapangan, tentukan waktu bermain, dan pantau status reservasi dalam satu sistem.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container py-5">
    <h2 class="text-center fw-bold mb-4">Fitur Sistem</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card feature p-4 text-center">
                <i class="fa-solid fa-table-tennis-paddle-ball fa-3x text-success mb-3"></i>
                <h5>Daftar Lapangan</h5>
                <p class="text-muted mb-0">Lihat jenis, lokasi, fasilitas, kapasitas, dan harga setiap lapangan.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature p-4 text-center">
                <i class="fa-solid fa-calendar-check fa-3x text-primary mb-3"></i>
                <h5>Reservasi Berdasarkan Jadwal</h5>
                <p class="text-muted mb-0">Pilih tanggal, jam mulai, dan jam selesai untuk menentukan durasi bermain.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature p-4 text-center">
                <i class="fa-solid fa-shield-check fa-3x text-warning mb-3"></i>
                <h5>Konfirmasi Admin</h5>
                <p class="text-muted mb-0">Admin dapat memeriksa jadwal bentrok dan menyetujui atau menolak reservasi.</p>
            </div>
        </div>
    </div>
</section>

<footer class="bg-dark text-white text-center py-4">
    <strong>UIN RF FUTSAL Reservation</strong>
    <div class="small text-white-50">Sistem Reservasi Lapangan FUTSAL UIN Raden Fatah</div>
</footer>
</body>
</html>
