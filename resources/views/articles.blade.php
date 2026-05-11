<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Articles - Blog Jema's</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #fdfaf9; font-family: 'Segoe UI', sans-serif; }
        .navbar { background-color: #44140a; }
        
        /* Navbar link active state */
        .navbar-dark .navbar-nav .nav-link.active {
            color: #fff !important;
            font-weight: 600;
        }

        .welcome-banner {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=1200');
            background-size: cover; background-position: center; height: 180px;
            display: flex; align-items: center; justify-content: center; color: white;
            border-radius: 0 0 20px 20px; margin-bottom: 40px; text-align: center;
        }

        .card { border-radius: 12px; border: 1px solid #eee; overflow: hidden; height: 100%; transition: 0.3s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .article-img { height: 190px; width: 100%; object-fit: cover; }
        
        .card-title { font-weight: bold; color: #44140a; font-size: 1.1rem; }
        .read-more { text-decoration: none; color: #44140a; font-weight: 600; font-size: 0.85rem; }
        .read-more:hover { color: #c6a664; }

        .btn-action {
            width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;
            border-radius: 8px; border: 1px solid #ddd; background-color: white; color: #333; transition: 0.2s;
        }
        .btn-edit:hover { border-color: #44140a; color: #44140a; }
        .btn-delete:hover { border-color: #dc3545; color: #dc3545; background-color: #fff5f5; }

        .btn-add { background-color: #44140a; color: white; border-radius: 8px; border: none; padding: 8px 18px; font-weight: 600; transition: 0.3s; }
        .btn-add:hover { background-color: #c6a664; color: #44140a; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}" style="color: #c6a664;">MyBlog</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('/profile') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('articles*') ? 'active' : '' }}" href="{{ url('/articles') }}">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="welcome-banner shadow-sm">
    <div>
        <h2 class="fw-bold m-0">Selamat Datang</h2>
        <p class="m-0 opacity-75">Website Blog Jema's</p>
    </div>
</div>

<div class="container pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold m-0" style="color: #44140a;">Berita Terbaru</h4>
        <a href="{{ route('articles.create') }}" class="btn btn-add shadow-sm">+ Tambah Artikel</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($articles as $article)
            <div class="col">
                <div class="card shadow-sm h-100">
                    <img src="{{ $article->image_url ? asset('images/' . $article->image_url) : 'https://via.placeholder.com/500x300' }}" class="article-img">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($article->content, 80) }}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <a href="#" class="read-more">Read More →</a>
                            <div class="d-flex gap-2">
                                <a href="{{ route('articles.edit', $article->id) }}" class="btn-action btn-edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Hapus?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col"><div class="card shadow-sm h-100"><img src="https://images.unsplash.com/photo-1447752875215-b2761acb3c5d?q=80&w=500" class="article-img"><div class="card-body d-flex flex-column"><h5 class="card-title">Wisata Alam Hidden Gem</h5><p class="card-text text-muted small">Eksplorasi air terjun tersembunyi di lereng Merbabu...</p><div class="mt-auto d-flex justify-content-between align-items-center"><a href="#" class="read-more">Read More →</a><div class="d-flex gap-2"><button class="btn-action btn-edit"><i class="bi bi-pencil"></i></button><button class="btn-action btn-delete"><i class="bi bi-trash"></i></button></div></div></div></div></div>
        <div class="col"><div class="card shadow-sm h-100"><img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=500" class="article-img"><div class="card-body d-flex flex-column"><h5 class="card-title">Coffee Shop Salatiga</h5><p class="card-text text-muted small">Tempat nongkrong asik dengan vibes sejuk...</p><div class="mt-auto d-flex justify-content-between align-items-center"><a href="#" class="read-more">Read More →</a><div class="d-flex gap-2"><button class="btn-action btn-edit"><i class="bi bi-pencil"></i></button><button class="btn-action btn-delete"><i class="bi bi-trash"></i></button></div></div></div></div></div>
        <div class="col"><div class="card shadow-sm h-100"><img src="https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=500" class="article-img"><div class="card-body d-flex flex-column"><h5 class="card-title">Sunset di Bawen</h5><p class="card-text text-muted small">Spot foto terbaik di pinggiran Rawa Pening...</p><div class="mt-auto d-flex justify-content-between align-items-center"><a href="#" class="read-more">Read More →</a><div class="d-flex gap-2"><button class="btn-action btn-edit"><i class="bi bi-pencil"></i></button><button class="btn-action btn-delete"><i class="bi bi-trash"></i></button></div></div></div></div></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>