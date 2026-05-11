<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel - MyBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fdfaf9; }
        .card { border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .btn-save { background-color: #44140a; color: white; border-radius: 10px; font-weight: bold; }
        .btn-save:hover { background-color: #5d1d0e; color: white; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-4">
                <h3 class="mb-4" style="color: #44140a; font-weight: 800;">Edit Artikel</h3>
                
                <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="mb-3">
                        <label class="form-label fw-bold">Judul Artikel</label>
                        <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Artikel</label>
                        <textarea name="content" class="form-control" rows="5" required>{{ $article->content }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Ganti Gambar (Opsional)</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-save px-4">Simpan Perubahan</button>
                        <a href="/articles" class="btn btn-outline-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>