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
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-custom d-flex flex-column" style="background: #fff;">
                    
                    {{-- Pembungkus Gambar Tanpa Properti overflow: hidden --}}
<div class="position-relative" style="height: 240px; width: 100%;">
    <img src="{{ $article->image_url }}" 
         class="w-100 h-100" 
         style="object-fit: cover; border-top-left-radius: 12px; border-top-right-radius: 12px;" 
         alt="{{ $article->title }}">
    
    {{-- BADGE KATEGORI: z-index dikunci paling atas --}}
    <div class="position-absolute start-50 translate-middle-x" style="bottom: -14px; z-index: 999;">
        <span class="badge text-white px-4 py-2 shadow" style="background-color: #800020; border-radius: 50px; font-size: 0.72rem; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; display: inline-block; white-space: nowrap;">
            {{ $article->category->name ?? 'Tanpa Kategori' }}
        </span>
    </div>
</div>
                    
                    {{-- Isi Konten Card (Rata Tengah Sesuai Layout Baru) --}}
                    <div class="card-body p-4 pt-4 d-flex flex-column text-center flex-grow-1">
                        <h5 class="card-title fw-bold mb-2 mt-2" style="line-height: 1.4; color: #1e1b18;">{{ $article->title }}</h5>
                        <p class="card-text text-muted mb-4" style="font-size: 0.95rem; line-height: 1.5;">
                            {{ Str::limit($article->content, 85) }}
                        </p>
                        
                        <div class="mt-auto">
                            {{-- Tombol READ MORE --}}
                            <a href="{{ route('articles.show', $article->id) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center mb-3" style="color: #800020; font-size: 0.85rem; letter-spacing: 0.5px;">
                                READ MORE →
                            </a>

                            {{-- Baris Tombol Aksi Kelola Konten (HANYA muncul saat login) --}}
                            @auth
                            <div class="d-flex border-top mt-2 action-row" style="border-color: #f1f1f1 !important;">
                                <div class="w-50 border-end py-2" style="border-color: #f1f1f1 !important;">
                                    <a href="{{ route('articles.edit', $article->id) }}" class="btn-action w-100 d-flex align-items-center justify-content-center gap-2 text-secondary text-decoration-none">
                                        <i class="bi bi-pencil-fill" style="font-size: 0.8rem;"></i> Edit
                                    </a>
                                </div>
                                <div class="w-50 py-2">
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Yakin hapus artikel ini?')" class="w-100 m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action w-100 d-flex align-items-center justify-content-center gap-2 text-secondary">
                                            <i class="bi bi-trash-fill" style="font-size: 0.8rem;"></i> Hapus
                                        </button>
                                    </form>
                                </div>
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
        box-shadow: 0 15px 30px rgba(128, 0, 32, 0.08) !important;
    }
    
    /* Styling Tombol Aksi Bawah Card Biar Selaras */
    .btn-action {
        background: none;
        border: none;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-action:hover {
        color: #800020 !important;
        opacity: 0.8;
    }
    .action-row {
        margin-left: -1.5rem;
        margin-right: -1.5rem;
        margin-bottom: -1.5rem;
    }
</style>
@endsection