@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row align-items-center py-5">
        <div class="col-md-6">
            <span class="badge mb-3 py-2 px-3 text-uppercase" style="background-color: #734b39; color: white; border-radius: 50px;">Welcome to My Space</span>
            <h1 class="display-4 fw-800 mb-4" style="color: #800020; font-weight: 800;">Mencatat Cerita,<br>Menjelajah Semesta.</h1>
            <p class="lead text-muted">Ruang berbagi mengenai petualangan mendaki gunung, eksplorasi estetika visual, Rekomendasi Coffeshop , dan konsep desain modern.</p>
            <a href="{{ route('articles.index') }}" class="btn btn-main btn-lg px-4 mt-3">Lihat Artikel</a>
        </div>
        <div class="col-md-6 mt-4 mt-md-0 text-center">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800" alt="Hero Image" class="img-fluid rounded-4 shadow-lg" style="max-height: 400px; object-fit: cover;">
        </div>
    </div>

    <div class="pt-5 mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: #1e1b18;">Artikel Terbaru</h3>
            <a href="{{ route('articles.index') }}" class="text-decoration-none fw-bold" style="color: #800020;">Lihat Semua →</a>
        </div>
        
        <div class="row g-4">
            @foreach($latestArticles as $article)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-custom d-flex flex-column">
                    <div class="img-container" style="height: 240px; width: 100%; overflow: hidden;">
                        <img src="{{ $article->image_url }}" 
                             class="w-100 h-100" 
                             style="object-fit: cover;" 
                             alt="{{ $article->title }}">
                    </div>
                    
                    <div class="card-body p-4 d-flex flex-column flex-grow-1">
                        <div class="mb-2">
                            <span class="badge badge-category" style="background: rgba(212, 175, 55, 0.15); color: #91761d; border-radius: 50px; font-size: 0.7rem;">INSIGHT</span>
                        </div>
                        <h5 class="card-title fw-bold mb-3" style="line-height: 1.4;">{{ $article->title }}</h5>
                        <p class="card-text text-muted mb-4" style="font-size: 0.95rem;">
                            {{ Str::limit($article->content, 85) }}
                        </p>
                        
                        <div class="mt-auto">
                            {{-- READ MORE --}}
                            <a href="{{ route('articles.show', $article->id) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center mb-3" style="color: #800020; font-size: 0.85rem; letter-spacing: 0.5px;">
                                READ MORE →
                            </a>

                            {{-- Edit & Hapus --}}
                            @auth
                            <div class="action-buttons">
                                <a href="{{ route('articles.edit', $article->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin hapus artikel ini?')">Hapus</button>
                                </form>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .card-custom {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-custom:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(128, 0, 32, 0.1) !important;
    }
    .transition:hover {
        opacity: 0.7;
        padding-left: 5px;
        transition: 0.3s;
    }
    
    /* Perbaikan untuk tombol Edit dan Hapus */
    .action-buttons {
        display: flex;
        gap: 16px;
        align-items: center;
    }
    
    .btn-edit {
        color: #d4a837 !important;
        text-decoration: none !important;
        font-size: 0.85rem;
        font-weight: 500;
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        line-height: normal;
        vertical-align: middle;
    }
    
    .btn-delete {
        background: none !important;
        border: none !important;
        color: #dc3545 !important;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        padding: 0;
        margin: 0;
        line-height: normal;
        vertical-align: middle;
    }
    
    .btn-edit:hover,
    .btn-delete:hover {
        opacity: 0.7;
    }
</style>
@endsection