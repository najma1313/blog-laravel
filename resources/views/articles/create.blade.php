@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Tambah Artikel Baru</h3>
        </div>
        <div class="card-body">
            <form action="/articles" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">-- Pilih Kategori Artikel --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Judul Artikel</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Isi Artikel</label>
                    <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Artikel</button>
                <a href="/articles" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection