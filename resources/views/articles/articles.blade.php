@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold" style="color: #800020;">Manajemen Konten</h2>
            <p class="text-muted">Buat narasi baru atau dokumentasikan petualanganmu di sini.</p>
        </div>
        
        @auth
        <button class="btn px-4 text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background-color: #800020; border-radius: 50px;">
            <i class="bi bi-pencil-fill me-2"></i>Tulis Artikel
        </button>
        @endauth
    </div>

    {{-- Filter Kategori --}}
    <div class="d-flex gap-3 mb-4 flex-wrap">
        <a href="{{ route('articles.index', ['category' => 'semua']) }}" 
           class="btn-filter {{ ($activeCategory ?? 'semua') == 'semua' ? 'active' : '' }}">Semua</a>
        
        @foreach($categories as $cat)
        <a href="{{ route('articles.index', ['category' => $cat->slug]) }}" 
           class="btn-filter {{ ($activeCategory ?? '') == $cat->slug ? 'active' : '' }}">
            {{ $cat->name }}
        </a>
        @endforeach
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- GRID 3 KOLOM --}}
    <div class="row g-4">
        @forelse($articles as $article)
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-custom d-flex flex-column">
                {{-- Gambar --}}
                <div class="img-container" style="height: 200px; width: 100%; overflow: hidden;">
                    @if($article->image_url && Str::startsWith($article->image_url, 'articles/'))
                        <img src="{{ asset('storage/' . $article->image_url) }}" class="w-100 h-100" style="object-fit: cover;">
                    @elseif($article->image_url)
                        <img src="{{ $article->image_url }}" class="w-100 h-100" style="object-fit: cover;" onerror="this.src='https://placehold.co/600x400?text=No+Image'">
                    @else
                        <img src="https://placehold.co/600x400?text=No+Image" class="w-100 h-100" style="object-fit: cover;">
                    @endif
                </div>
                
                <div class="card-body p-4 d-flex flex-column flex-grow-1">
                    {{-- BADGE MAROON DENGAN TULISAN PUTIH DI TENGAH --}}
                    <div class="text-center mb-3">
                        <span class="badge-category" style="background: #800020; color: white; border-radius: 50px; font-size: 0.7rem; padding: 5px 15px; display: inline-block;">
                            {{ strtoupper($article->category->name ?? 'UMUM') }}
                        </span>
                    </div>
                    
                    <h5 class="card-title fw-bold mb-3 text-center" style="line-height: 1.4; font-size: 1.1rem;">{{ $article->title }}</h5>
                    <p class="card-text text-muted mb-4 text-center" style="font-size: 0.9rem;">
                        {{ Str::limit($article->content, 80) }}
                    </p>
                    
                    <div class="mt-auto">
                        {{-- READ MORE di tengah --}}
                        <div class="text-center mb-3">
                            <a href="{{ route('articles.show', $article->id) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center transition" style="color: #800020; font-size: 0.85rem; letter-spacing: 0.5px;">
                                READ MORE 
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right-short ms-1" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </a>
                        </div>

                        {{-- Edit & Hapus  --}}
                        @auth
                        <div class="text-center">
                            <div class="d-flex gap-4 justify-content-center">
                                <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $article->id }}">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin hapus artikel ini?')">
                                        <i class="bi bi-trash3-fill"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Edit --}}
        @auth
        <div class="modal fade" id="modalEdit{{ $article->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-lg">
                    <div class="p-3 rounded-top-4" style="background-color: #800020;">
                        <h5 class="text-white mb-0 px-2 fw-bold">Perbarui Artikel</h5>
                    </div>
                    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body p-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul Artikel</label>
                                <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Kategori</label>
                                <select name="category_id" class="form-select" required>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $article->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Isi Cerita</label>
                                <textarea name="content" rows="5" class="form-control" required>{{ $article->content }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Gambar</label>
                                <div class="d-flex gap-2 mb-3">
                                    <input type="radio" class="btn-check" name="img_source" id="editFile{{ $article->id }}" value="file" checked onclick="toggleEdit('file', {{ $article->id }})">
                                    <label class="btn-outline-custom flex-fill py-2 text-center" for="editFile{{ $article->id }}">Upload File</label>
                                    <input type="radio" class="btn-check" name="img_source" id="editUrl{{ $article->id }}" value="url" onclick="toggleEdit('url', {{ $article->id }})">
                                    <label class="btn-outline-custom flex-fill py-2 text-center" for="editUrl{{ $article->id }}">URL Gambar</label>
                                </div>
                                <div id="boxFileEdit{{ $article->id }}">
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div id="boxUrlEdit{{ $article->id }}" style="display: none;">
                                    <input type="url" name="image_url" class="form-control" placeholder="https://...">
                                </div>
                            </div>
                        </div>
                        <div class="px-4 pb-4">
                            <button type="submit" class="btn w-100 text-white fw-bold py-2" style="background-color: #800020; border-radius: 12px;">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endauth
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada artikel di kategori ini.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- Modal Tambah Artikel --}}
@auth
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="p-3 rounded-top-4" style="background-color: #800020;">
                <h5 class="text-white mb-0 px-2 fw-bold">Publikasi Baru</h5>
            </div>
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Artikel</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Isi Cerita</label>
                        <textarea name="content" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Gambar</label>
                        <div class="d-flex gap-2 mb-3">
                            <input type="radio" class="btn-check" name="img_source" id="addF" value="file" checked onclick="toggleAdd('file')">
                            <label class="btn-outline-custom flex-fill py-2 text-center" for="addF">Upload File</label>
                            <input type="radio" class="btn-check" name="img_source" id="addL" value="url" onclick="toggleAdd('url')">
                            <label class="btn-outline-custom flex-fill py-2 text-center" for="addL">URL Gambar</label>
                        </div>
                        <div id="boxFileAdd">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div id="boxUrlAdd" style="display: none;">
                            <input type="url" name="image_url" class="form-control" placeholder="https://...">
                        </div>
                    </div>
                </div>
                <div class="px-4 pb-4">
                    <button type="submit" class="btn w-100 text-white fw-bold py-2" style="background-color: #800020; border-radius: 12px;">Tampilkan Artikel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth

<style>
    .card-custom {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-custom:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(128, 0, 32, 0.1) !important;
    }
    
    .btn-filter {
        padding: 8px 20px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 500;
        background-color: #f0f0f0;
        color: #333;
        transition: 0.3s;
    }
    .btn-filter:hover, .btn-filter.active {
        background-color: #800020;
        color: white;
    }
    
    .btn-edit {
        background: none;
        border: none;
        color: #6c6a69;
        font-size: 0.85rem;
        cursor: pointer;
        padding: 0;
    }
    .btn-delete {
        background: none;
        border: none;
        color: #6c6a69;
        font-size: 0.85rem;
        cursor: pointer;
        padding: 0;
    }
    
    .btn-outline-custom {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        background: white;
        padding: 8px;
        cursor: pointer;
    }
    .btn-check:checked + .btn-outline-custom {
        border-color: #800020;
        color: #800020;
        background-color: #fff0f0;
    }
    
    .transition:hover {
        opacity: 0.7;
        padding-left: 5px;
        transition: 0.3s;
    }
</style>

<script>
    function toggleAdd(type) {
        document.getElementById('boxFileAdd').style.display = type === 'file' ? 'block' : 'none';
        document.getElementById('boxUrlAdd').style.display = type === 'url' ? 'block' : 'none';
    }
    
    function toggleEdit(type, id) {
        document.getElementById('boxFileEdit' + id).style.display = type === 'file' ? 'block' : 'none';
        document.getElementById('boxUrlEdit' + id).style.display = type === 'url' ? 'block' : 'none';
    }
</script>
@endsection