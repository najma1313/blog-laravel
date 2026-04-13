<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - MyBlog</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
        }

        /* NAVBAR */
        .navbar {
            background: #441208;
        }

        .navbar a {
            color: white !important;
        }

        /* CAROUSEL TEXT */
        .carousel-caption {
            background: rgba(0,0,0,0.5);
            padding: 15px;
            border-radius: 10px;
        }

        /* CARD */
        .card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        /* FOOTER */
        footer {
            background: #431007d6;
            color: white;
        }
    </style>
</head>
<body>

<!--  NAVBAR (SUDAH FIX ROUTE) -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand text-white" href="/">MyBlog</a>

    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      ☰
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="/articles">Articles</a></li>
        <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!--  CAROUSEL -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img src="https://picsum.photos/1200/400?1" class="d-block w-100">
      <div class="carousel-caption">
        <h4>Selamat Datang</h4>
        <p>Website Blog Jema's</p>
      </div>
    </div>

    <div class="carousel-item">
      <img src="https://picsum.photos/1200/400?2" class="d-block w-100">
      <div class="carousel-caption">
        <h4>Artikel Menarik</h4>
        <p>Baca berbagai informasi terbaru</p>
      </div>
    </div>

    <div class="carousel-item">
      <img src="https://picsum.photos/1200/400?3" class="d-block w-100">
      <div class="carousel-caption">
        <h4>Update Setiap Hari</h4>
        <p>Selalu fresh & up to date</p>
      </div>
    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!--  CONTENT -->
<div class="container my-5">
  <h2 class="text-center mb-4">Berita Terbaru</h2>

  <div class="row g-4">

    <div class="col-md-4">
      <div class="card">
        <img src="https://picsum.photos/400/200?4" class="card-img-top">
        <div class="card-body">
          <h5>Wisata Alam</h5>
          <p class="text-muted">Eksplorasi Hidden Gem: Air Terjun di Jawa Tengah.</p>
          <a href="/articles" class="btn btn-outline-dark">Baca</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <img src="https://picsum.photos/400/200?5" class="card-img-top">
        <div class="card-body">
          <h5>Menangkap Kenangan dalam Butiran</h5>
          <p class="text-muted">Foto yang tak sempurna lebih hidup dan bermakna?.</p>
          <a href="/articles" class="btn btn-outline-dark">Baca</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <img src="https://picsum.photos/400/200?6" class="card-img-top">
        <div class="card-body">
          <h5>Tutor Menghilangkan Stres</h5>
          <p class="text-muted">Rekomendasi tempat healing terbaik.</p>
          <a href="/articles" class="btn btn-outline-dark">Baca</a>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- 🔥 FOOTER -->
<footer class="text-center p-3">
  <p>©️ 2026 Najma Fatiha</p>
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>