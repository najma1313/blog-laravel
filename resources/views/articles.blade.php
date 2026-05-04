<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Articles - MyBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fdfaf9; font-family: 'Poppins', sans-serif; }
        .navbar { background-color: #44140a; }
        .card { border-radius: 15px; border: none; transition: 0.3s; overflow: hidden; height: 100%; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .btn-add { background-color: #44140a; color: white; border-radius: 8px; font-weight: bold; }
        .btn-add:hover { background-color: #5d1d0e; color: white; }
        .article-img { height: 200px; width: 100%; object-fit: cover; }
        .card-title { color: #44140a; font-weight: bold; font-size: 1.1rem; }
        .btn-delete { color: #b04444; border: 1px solid #ebcccc; border-radius: 6px; padding: 2px 12px; text-decoration: none; font-size: 0.85rem; background: white; }
        .btn-delete:hover { background: #f2dede; }
        .nav-link { color: rgba(255,255,255,0.8) !important; padding: 10px 0; }
        .nav-link:hover { color: white !important; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-5 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">MyBlog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- MENU LENGKAP SESUAI GAMBAR -->
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
                <li class="nav-item"><a class="nav-link active fw-bold" href="/articles">Articles</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color: #44140a; font-weight: bold;">My Articles</h2>
        <a href="{{ route('articles.create') }}" class="btn btn-add shadow-sm">+ Tambah Artikel</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        
        <!-- DATA ASLI DARI DATABASE -->
        @foreach ($articles as $article)
            <div class="col">
                <div class="card shadow-sm">
                    <img src="{{ $article->image_url ? asset('images/' . $article->image_url) : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=500' }}" class="article-img">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="text-muted small">{{ Str::limit($article->content, 60) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">{{ $article->created_at->format('d M Y') }}</small>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Hapus?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- 5 CARD CONTOH (TEMA BERBEDA) -->
        <div class="col">
            <div class="card shadow-sm">
                <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=500" class="article-img">
                <div class="card-body">
                    <h5 class="card-title">Rekomendasi Coffeeshop Hits Salatiga</h5>
                    <p class="text-muted small">Tempat nongkrong asik dengan vibes sejuk dan kopi lokal terbaik.</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">04 May 2026</small>
                        <button class="btn-delete">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm">
                <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=500" class="article-img">
                <div class="card-body">
                    <h5 class="card-title">Sunrise di Puncak Gunung Merbabu</h5>
                    <p class="text-muted small">Momen magis saat matahari terbit di balik samudra awan.</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">03 May 2026</small>
                        <button class="btn-delete">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=500" class="article-img">
                <div class="card-body">
                    <h5 class="card-title">Kuliner Malam Ronde Sekoteng</h5>
                    <p class="text-muted small">Menghangatkan badan dengan jahe dan ronde legendaris Salatiga.</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">02 May 2026</small>
                        <button class="btn-delete">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm">
                <img src="https://images.unsplash.com/photo-1542038784456-1ea8e935640e?q=80&w=500" class="article-img">
                <div class="card-body">
                    <h5 class="card-title">Tips Foto Polaroid Aesthetic</h5>
                    <p class="text-muted small">Teknik flash dan framing untuk hasil foto yang vintage abis.</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">01 May 2026</small>
                        <button class="btn-delete">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm">
                <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?q=80&w=500" class="article-img">
                <div class="card-body">
                    <h5 class="card-title">Productive Day: Work from Cafe</h5>
                    <p class="text-muted small">Cara tetap fokus menyelesaikan tugas kuliah sambil menikmati latte.</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">30 Apr 2026</small>
                        <button class="btn-delete">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<footer class="py-5"></footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>