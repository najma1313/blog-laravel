<!DOCTYPE html>
<html>
<head>
    <title>Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahan dikit biar gambar seragam ukurannya */
        .card-img-top {
            height: 180px;
            object-fit: cover;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body style="background:#f5f7fa;">

<nav class="navbar" style="background:#44140a;">
  <div class="container">
    <a class="navbar-brand text-white" href="/">MyBlog</a>
    <div>
      <a href="/" class="text-white me-3">Home</a>
      <a href="/profile" class="text-white me-3">Profile</a>
      <a href="/articles" class="text-white me-3">Articles</a>
      <a href="/contact" class="text-white">Contact</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">My Articles</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card p-3 h-100">
                <img src="https://images.unsplash.com/photo-1587620962725-abab7fe55159?w=500" class="card-img-top rounded mb-3" alt="Laravel">
                <h5>Mastering MVC Laravel</h5>
                <p class="text-muted small">Memahami alur kerja Model, View, dan Controller untuk web yang lebih terstruktur.</p>
                <a href="#" class="btn btn-outline-dark mt-auto">Read More</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 h-100">
                <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=500" class="card-img-top rounded mb-3" alt="Flutter">
                <h5>Build App with Flutter</h5>
                <p class="text-muted small">Eksperimen menyusun widget untuk membangun CoffeeApp yang estetik dan fungsional.</p>
                <a href="#" class="btn btn-outline-dark mt-auto">Read More</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 h-100">
                <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=500" class="card-img-top rounded mb-3" alt="Merbabu">
                <h5>Merbabu: Above the Clouds</h5>
                <p class="text-muted small">Dokumentasi perjalanan mendaki jalur Selo dan keindahan sabana di puncak gunung.</p>
                <a href="#" class="btn btn-outline-dark mt-auto">Read More</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 h-100">
                <img src="https://images.unsplash.com/photo-1526285849717-482456cd7436?w=500" class="card-img-top rounded mb-3" alt="Polaroid">
                <h5>The Art of Polaroid Blur</h5>
                <p class="text-muted small">Teknik menggunakan hard flash dan intentional blur untuk hasil foto yang sangat nostalgia.</p>
                <a href="#" class="btn btn-outline-dark mt-auto">Read More</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 h-100">
                <img src="https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?w=500" class="card-img-top rounded mb-3" alt="GitHub">
                <h5>Commit Your Code!</h5>
                <p class="text-muted small">Tips mengelola repositori GitHub agar tugas kuliah semester 2 kamu tetap terorganisir.</p>
                <a href="#" class="btn btn-outline-dark mt-auto">Read More</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 h-100">
                <img src="https://images.unsplash.com/photo-1558655146-d09347e92766?w=500" class="card-img-top rounded mb-3" alt="UI Design">
                <h5>Aesthetic Gradient Tips</h5>
                <p class="text-muted small">Cara memilih perpaduan warna gradient yang modern dan nyaman untuk user interface.</p>
                <a href="#" class="btn btn-outline-dark mt-auto">Read More</a>
            </div>
        </div>

    </div>
</div>

<footer class="text-center mt-5 p-3" style="background:#44160a;color:white;">
    ©️ 2026 Najma Fatiha
</footer>

</body>
</html>