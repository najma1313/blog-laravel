@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-white border-0 pt-4">
                    <h4 class="fw-bold" style="color: #800020;">Edit Artikel</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Artikel</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $article->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Konten Artikel</label>
                            <textarea name="content" rows="10" class="form-control" required>{{ old('content', $article->content) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Gambar Utama</label>
                            
                            {{-- Pilihan sumber gambar --}}
                            <div class="d-flex gap-2 mb-3">
                                <input type="radio" class="btn-check" name="img_source" id="editFile" value="file" checked onclick="toggleImageSource('file')">
                                <label class="btn btn-outline-custom flex-fill py-3 d-flex flex-column align-items-center gap-2" for="editFile">
                                    <i class="bi bi-cloud-arrow-up fs-4"></i>
                                    <span class="small fw-bold">Upload Lokal</span>
                                </label>

                                <input type="radio" class="btn-check" name="img_source" id="editUrl" value="url" onclick="toggleImageSource('url')">
                                <label class="btn btn-outline-custom flex-fill py-3 d-flex flex-column align-items-center gap-2" for="editUrl">
                                    <i class="bi bi-link-45deg fs-4"></i>
                                    <span class="small fw-bold">Tautan URL</span>
                                </label>
                            </div>

                            {{-- Upload file lokal --}}
                            <div id="boxFileEdit" class="p-3 border border-dashed rounded-3 bg-white">
                                @if($article->image_url && !Str::startsWith($article->image_url, 'http'))
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $article->image_url) }}" width="150" class="rounded">
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control form-control-sm border-0 shadow-none">
                                <div class="mt-1 text-muted" style="font-size: 0.7rem;">Format: JPG, PNG (Max 2MB)</div>
                            </div>

                            {{-- Input URL gambar --}}
                            <div id="boxUrlEdit" style="display: none;">
                                @if($article->image_url && Str::startsWith($article->image_url, 'http'))
                                    <div class="mb-2">
                                        <img src="{{ $article->image_url }}" width="150" class="rounded">
                                    </div>
                                @endif
                                <input type="url" name="image_url" class="form-control bg-light border-0" placeholder="https://example.com/gambar.jpg" value="{{ Str::startsWith($article->image_url, 'http') ? $article->image_url : '' }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('home') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn" style="background-color: #800020; color: white;">Update Artikel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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
</style>

<script>
    function toggleImageSource(type) {
        const boxFile = document.getElementById('boxFileEdit');
        const boxUrl = document.getElementById('boxUrlEdit');
        
        if (type === 'file') {
            boxFile.style.display = 'block';
            boxUrl.style.display = 'none';
        } else {
            boxFile.style.display = 'none';
            boxUrl.style.display = 'block';
        }
    }
</script>
@endsection