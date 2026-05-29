@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            {{-- Navigasi Atas & Tombol Kembali --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('articles.index') }}" class="btn btn-light rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm text-secondary border-0 btn-back" style="font-size: 0.9rem; font-weight: 500;">
                    ← Kembali
                </a>
                
                {{-- Lencana Kategori Mengambang Kanan --}}
                <span class="badge text-white px-4 py-2 shadow-sm" style="background-color: #800020; border-radius: 50px; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase;">
                    {{ $article->category->name ?? 'Tanpa Kategori' }}
                </span>
            </div>

            {{-- Artikel Utama Wrapper --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5" style="background: #ffffff;">
                
                {{-- Header Judul Konten --}}
                <div class="p-4 p-md-5 pb-0 bg-white">
                    <h1 class="display-5 fw-bold mb-3" style="color: #1e1b18; line-height: 1.3; letter-spacing: -0.5px;">
                        {{ $article->title }}
                    </h1>
                    
                    {{-- Metadata Tambahan (Opsional, Menambah Kesan Professional) --}}
                    <div class="d-flex align-items-center gap-3 text-muted mb-4" style="font-size: 0.88rem;">
                        <span class="d-flex align-items-center gap-1">
                            Diunggah oleh <strong>Jema</strong>
                        </span>
                        <span>•</span>
                        <span>{{ $article->created_at ? $article->created_at->isoFormat('D MMMM Y') : 'Baru Saja' }}</span>
                    </div>
                </div>

                {{-- Area Foto Utama dengan Frame Estetik --}}
                <div class="px-4 px-md-5">
                    <div class="position-relative overflow-hidden rounded-4 shadow-sm" style="max-height: 480px;">
                        @if(Str::startsWith($article->image_url, 'articles/'))
                            <img src="{{ asset('storage/' . $article->image_url) }}" class="w-100 h-100 img-fluid" style="object-fit: cover; max-height: 480px;" alt="{{ $article->title }}">
                        @else
                            <img src="{{ $article->image_url }}" class="w-100 h-100 img-fluid" style="object-fit: cover; max-height: 480px;" alt="{{ $article->title }}" onerror="this.src='https://placehold.co/800x500?text=Image+Not+Found'">
                        @endif
                    </div>
                </div>

                {{-- Isi Teks Narasi Cerita --}}
                <div class="card-body p-4 p-md-5 pt-4">
                    <div class="article-text text-muted" style="font-size: 1.1rem; line-height: 1.8; font-weight: 400; text-align: justify; letter-spacing: 0.2px;">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    {{-- Panel Tombol Manajemen Konten (Hanya untuk Admin/User Logged In) --}}
                    @auth
                    <hr class="my-4" style="border-color: #f1f1f1;">
                    <div class="d-flex justify-content-end gap-3 align-items-center">
                        <span class="text-muted me-auto small d-flex align-items-center gap-2">
                            Kelola Artikel ini:
                        </span>
                        
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn rounded-pill px-4 text-decoration-none d-flex align-items-center gap-2" style="background-color: rgba(212, 168, 55, 0.1); color: #b0841a; font-weight: 600; font-size: 0.88rem; border: 1px solid rgba(212, 168, 55, 0.2);">
                            Edit Cerita
                        </a>
                        
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus narasi cerita ini dari semesta?')" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn rounded-pill px-4 d-flex align-items-center gap-2" style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545; font-weight: 600; font-size: 0.88rem; border: 1px solid rgba(220, 53, 69, 0.2);">
                                Hapus
                            </button>
                        </form>
                    </div>
                    @endauth

                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Transisi Halus untuk Efek Hover Interaktif */
    .btn-back {
        transition: all 0.3s ease;
    }
    .btn-back:hover {
        background-color: #800020 !important;
        color: white !important;
        transform: translateX(-4px);
    }
    
    /* Sentuhan Paragraf Pertama Agar Lebih Bold ala Majalah */
    .article-text p:first-of-type, 
    .article-text {
        color: #333333 !important;
    }
</style>
@endsection