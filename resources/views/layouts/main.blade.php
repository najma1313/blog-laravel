<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Najma Archive | Personal Blog</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Warna diselaraskan dengan gambar maroon gelap yang kamu sukai */
            --primary: #3d0a0a; 
            --accent: #d4af37;  
            --bg-soft: #ffffff; /* Latar belakang murni putih */
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-soft);
            color: #1e1b18;
        }

        /* Navbar dengan latar belakang Maroon Gelap solid sesuai gambar */
        .navbar {
            background: #3d0a0a !important;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        /* Logo Najma Archive berwarna putih solid terang */
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: #ffffff !important;
            letter-spacing: 1px;
        }

        /* Menu link teks diubah jadi putih semi-transparan */
        .nav-link {
            font-weight: 600;
            color: rgba(255, 255, 255, 0.75) !important;
            margin: 0 10px;
            transition: 0.3s;
        }

        /* Hover dan Active menu diberi warna putih murni */
        .nav-link:hover, .nav-link.active {
            color: #ffffff !important;
        }

        /* Tombol Let's Talk / Login */
        .btn-main {
            background: #721c24;
            color: white !important;
            border-radius: 50px;
            padding: 8px 22px;
            font-weight: 600;
            transition: 0.3s;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .btn-main:hover {
            background: #8a252e;
            transform: translateY(-2px);
        }

        /* Tombol khusus Logout jika sudah login */
        .btn-logout {
            background: #dc3545;
            color: white !important;
            border-radius: 50px;
            padding: 8px 22px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
        }

        .btn-logout:hover {
            background: #bd2130;
            transform: translateY(-2px);
        }

        .card-custom {
            transition: transform 0.3s ease;
        }
        .card-custom:hover {
            transform: translateY(-10px);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Jema.Archive</a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('articles*') ? 'active' : '' }}" href="{{ route('articles.index') }}">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>

                    {{-- Logika Authentication Tombol Pojok Kanan --}}
                    @auth
                        <li class="nav-item ms-lg-3">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-logout shadow-sm">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-main shadow-sm" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="py-5 text-center mt-5" style="border-top: 1px solid rgba(0,0,0,0.05)">
        <p class="text-muted mb-0">Designed with | for Digital Explorers.</p>
        <small class="text-muted mt-2 d-block">© 2026 Jema.Archive - Digital Diary</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>