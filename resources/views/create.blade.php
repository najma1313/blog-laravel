<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Artikel - MyBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fdfaf9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #44140a; }
        .card { border-radius: 20px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .btn-save { background-color: #44140a; color: white; border-radius: 10px; padding: 10px 30px; }
        .btn-save:hover { background-color: #5d1d0e; color: white; }
        .form-label { font-weight: bold; color: #44140a; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark mb-5 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/articles">MyBlog</a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="mb-4 text-center" style="color: #44140a;">Tulis Artikel Baru</h3>
                
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul Artikel</label>
                        <input type="text" name="title" class="form-control" placeholder="Masukkan judul..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Gambar</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Konten</label>
                        <textarea name="content" class="form-control" rows="5" placeholder="Mulai menulis..." required></textarea>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="/articles" class="text-muted text-decoration-none">Kembali</a>
                        <button type="submit" class="btn btn-save shadow">Simpan Artikel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>