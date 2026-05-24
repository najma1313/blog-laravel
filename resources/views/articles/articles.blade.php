@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold" style="color: #800020;">Manajemen Konten</h2>
            <p class="text-muted">Buat narasi baru atau dokumentasikan petualanganmu di sini.</p>
        </div>
        
        {{-- Tombol Tulis Artikel - HANYA untuk user yang login --}}
        @auth
        <button class="btn px-4 text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background-color: #800020; border-radius: 50px;">
            <i class="bi bi-pencil-fill me-2"></i>Tulis Artikel
        </button>
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @foreach($articles as $article)
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
                <div style="height: 220px; overflow: hidden; background-color: #f8f9fa;">
                    @if(Str::startsWith($article->image_url, 'articles/'))
                        <img src="{{ asset('storage/' . $article->image_url) }}" class="w-100 h-100" style="object-fit: cover;">
                    @else
                        <img src="{{ $article->image_url }}" class="w-100 h-100" style="object-fit: cover;" onerror="this.src='https://placehold.co/600x400?text=Image+Not+Found'">
                    @endif
                </div>

                <div class="card-body p-4 d-flex flex-column">
                    <h5 class="fw-bold mb-2">{{ $article->title }}</h5>
                    <p class="text-muted small mb-4">{{ Str::limit($article->content, 90) }}</p>
                    
                    {{-- READ MORE (muncul untuk semua user) --}}
                    <div class="mt-auto">
                        <a href="{{ route('articles.show', $article->id) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center mb-3" style="color: #800020; font-size: 0.85rem; letter-spacing: 0.5px;">
                            READ MORE →
                        </a>

                        {{-- Edit & Hapus (HANYA untuk user yang login) --}}
                        @auth
                        <div class="d-flex gap-3">
                            <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $article->id }}" style="background: none; border: none; color: #d4a837; font-size: 0.85rem; cursor: pointer; padding: 0;">Edit</button>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #dc3545; font-size: 0.85rem; cursor: pointer; padding: 0;">Hapus</button>
                            </form>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Edit (HANYA muncul jika user login, tapi aman karena ada @auth di atas) --}}
        @auth
        <div class="modal fade" id="modalEdit{{ $article->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-lg">
                    <div class="p-3 rounded-top-4" style="background-color: #800020;">
                        <h5 class="text-white mb-0 px-2 fw-bold d-flex align-items-center">
                            <i class="bi bi-pencil-square me-2"></i> Perbarui Artikel
                        </h5>
                    </div>
                    
                    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="modal-body p-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-secondary">Judul Artikel <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control bg-light border-0 py-2" value="{{ $article->title }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-secondary">Isi Cerita <span class="text-danger">*</span></label>
                                <textarea name="content" rows="5" class="form-control bg-light border-0" required>{{ $article->content }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-secondary">Gambar Utama</label>
                                <div class="d-flex gap-2 mb-3">
                                    <input type="radio" class="btn-check" name="img_source_{{ $article->id }}" id="editF{{ $article->id }}" value="file" checked onclick="toggleEdit('file', {{ $article->id }})">
                                    <label class="btn btn-outline-custom flex-fill py-3 d-flex flex-column align-items-center gap-2" for="editF{{ $article->id }}">
                                        <i class="bi bi-cloud-arrow-up fs-4"></i>
                                        <span class="small fw-bold">Upload Lokal</span>
                                    </label>

                                    <input type="radio" class="btn-check" name="img_source_{{ $article->id }}" id="editL{{ $article->id }}" value="url" onclick="toggleEdit('url', {{ $article->id }})">
                                    <label class="btn btn-outline-custom flex-fill py-3 d-flex flex-column align-items-center gap-2" for="editL{{ $article->id }}">
                                        <i class="bi bi-link-45deg fs-4"></i>
                                        <span class="small fw-bold">Tautan URL</span>
                                    </label>
                                </div>
                                
                                <div id="boxFileEdit{{ $article->id }}" class="p-3 border border-dashed rounded-3 bg-white">
                                    <input type="file" name="image" class="form-control form-control-sm border-0 shadow-none">
                                    <div class="mt-1 text-muted" style="font-size: 0.7rem;">Format: JPG, PNG (Max 2MB)</div>
                                </div>
                                <div id="boxUrlEdit{{ $article->id }}" style="display: none;">
                                    <input type="url" name="image_url" class="form-control bg-light border-0" placeholder="https://..." value="{{ !Str::startsWith($article->image_url, 'articles/') ? $article->image_url : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="px-4 pb-4">
                            <button type="submit" class="btn w-100 text-white fw-bold py-2 shadow-sm" style="background-color: #800020; border-radius: 12px;">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endauth
        @endforeach
    </div>
</div>

{{-- Modal Tambah Artikel (HANYA untuk user yang login) --}}
@auth
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="p-3 rounded-top-4" style="background-color: #800020;">
                <h5 class="text-white mb-0 px-2 fw-bold d-flex align-items-center">
                    <i class="bi bi-plus-circle me-2"></i> Publikasi Baru
                </h5>
            </div>
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-secondary">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control bg-light border-0 py-2" placeholder="Apa judul ceritamu hari ini?" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary">Isi Cerita <span class="text-danger">*</span></label>
                        <textarea name="content" rows="5" class="form-control bg-light border-0" placeholder="Tuliskan konten lengkap disini..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-secondary">Gambar Utama</label>
                        <div class="d-flex gap-2 mb-3">
                            <input type="radio" class="btn-check" name="img_source" id="addF" value="file" checked onclick="toggleAdd('file')">
                            <label class="btn btn-outline-custom flex-fill py-3 d-flex flex-column align-items-center gap-2" for="addF">
                                <i class="bi bi-cloud-arrow-up fs-4"></i>
                                <span class="small fw-bold">Upload Lokal</span>
                            </label>

                            <input type="radio" class="btn-check" name="img_source" id="addL" value="url" onclick="toggleAdd('url')">
                            <label class="btn btn-outline-custom flex-fill py-3 d-flex flex-column align-items-center gap-2" for="addL">
                                <i class="bi bi-link-45deg fs-4"></i>
                                <span class="small fw-bold">Tautan URL</span>
                            </label>
                        </div>
                        <div id="boxFileAdd" class="p-3 border border-dashed rounded-3 bg-white">
                            <input type="file" name="image" class="form-control form-control-sm border-0 shadow-none">
                            <div class="mt-1 text-muted" style="font-size: 0.7rem;">Format: JPG, PNG (Max 2MB)</div>
                        </div>
                        <div id="boxUrlAdd" style="display: none;">
                            <input type="url" name="image_url" class="form-control bg-light border-0" placeholder="Masukkan link gambar disini...">
                        </div>
                    </div>
                </div>
                <div class="px-4 pb-4">
                    <button type="submit" class="btn w-100 text-white fw-bold py-2 shadow-sm" style="background-color: #800020; border-radius: 12px;">Tampilkan Artikel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth

<style>
    .card-hover { transition: 0.3s; }
    .card-hover:hover { transform: translateY(-5px); }
    
    .btn-outline-custom {
        color: #495057;
        border: 1px solid #dee2e6;
        background-color: #fff;
        border-radius: 12px;
        transition: 0.2s;
    }
    .btn-check:checked + .btn-outline-custom {
        background-color: #fff;
        border-color: #800020;
        color: #800020;
        box-shadow: 0 0 0 1px #800020;
    }
    
    .border-dashed {
        border-style: dashed !important;
        border-width: 2px !important;
        border-color: #dee2e6 !important;
    }
    
    .form-control:focus {
        border: 1px solid #800020;
        box-shadow: none;
        background: #fff !important;
    }
</style>

<script>
    function toggleAdd(type) {
        document.getElementById('boxFileAdd').style.display = (type === 'file') ? 'block' : 'none';
        document.getElementById('boxUrlAdd').style.display = (type === 'url') ? 'block' : 'none';
    }
    function toggleEdit(type, id) {
        document.getElementById('boxFileEdit' + id).style.display = (type === 'file') ? 'block' : 'none';
        document.getElementById('boxUrlEdit' + id).style.display = (type === 'url') ? 'block' : 'none';
    }
</script>
@endsection