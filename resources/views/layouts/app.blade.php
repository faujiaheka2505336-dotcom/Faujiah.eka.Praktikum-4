<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Berita Desa') — Jalatrang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/desa.css') }}">
</head>
<body>
    <nav class="navbar navbar-desa py-2">
        <div class="container">
            <a class="d-flex align-items-center gap-2 text-decoration-none" href="{{ route('berita.index') }}">
                <img src="https://jalatrang.id/assets/images/info_desa/logo.png" alt="Logo Desa" width="36" height="36"
                     style="object-fit:contain" onerror="this.onerror=null;this.src='https://jalatrang.id/assets/template/img/logo_ciamis.png'">
                <span class="brand-title">
                    PEMERINTAH DESA JALATRANG
                    <span class="brand-sub">KECAMATAN CIPAKU KABUPATEN CIAMIS</span>
                </span>
            </a>
            <a href="{{ route('berita.index') }}" class="nav-pill">Berita</a>
        </div>
    </nav>

    <div class="container my-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="footer-desa py-4 mt-5">
        <div class="container">
            <strong class="text-white">Pemerintah Desa Jalatrang</strong><br>
            Jalan Raya Cipaku Nomor 181, Desa Jalatrang, Kecamatan Cipaku, Kabupaten Ciamis<br>
            <a href="{{ route('berita.index') }}">Berita</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
