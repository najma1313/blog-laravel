<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jema.Archive | Personal Blog</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #800020; /* Maroon */
            --accent: #d4af37;  /* Gold */
            --bg-soft: #fcfbf7;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-soft);
            color: #1e1b18;
        }

        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(252, 251, 247, 0.9) !important;
            padding: 20px 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            background: linear-gradient(45deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-link {
            font-weight: 600;
            color: #1e1b18 !important;
            margin: 0 10px;
            transition: 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
        }

        .btn-main {
            background: var(--primary);
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
        }

        .btn-main:hover {
            background: #600018;
            color: white;
            transform: translateY(-2px);
        }

        /* Card Style Global */
        .card-custom {
            transition: transform 0.3s ease;
        }
        .card-custom:hover {
            transform: translateY(-10px);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
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
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-main shadow-sm" href="{{ route('contact') }}">Let's Talk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="py-5 text-center mt-5" style="border-top: 1px solid rgba(0,0,0,0.05)">
        <p class="text-muted mb-0">Designed with|for Digital Explorers.</p>
        <small class="text-muted mt-2 d-block">© 2026 Jema.Archive - Digital Diary</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>