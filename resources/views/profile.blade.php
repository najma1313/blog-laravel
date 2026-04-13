<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #331307, #dbddbd);
            color: white;
        }

        /* NAVBAR */
        .navbar {
            background: transparent;
        }

        .navbar a {
            color: #cbd5e1 !important;
        }

        .navbar a:hover {
            color: #541d0e !important;
        }

        /* PROFILE CARD */
        .profile-box {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            max-width: 400px;
            margin: 80px auto;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #5a190e;
            margin-bottom: 15px;
        }

        .profile-box p {
            color: #cbd5e1;
        }

        /* FOOTER */
        footer {
            background: transparent;
            border-top: 1px solid rgba(255,255,255,0.2);
        }
    </style>
</head>

<body>

<!-- 🔥 NAVBAR -->
<nav class="navbar">
  <div class="container">
    <a class="navbar-brand text-white" href="/">MyBlog</a>
    <div>
      <a href="/" class="me-3">Home</a>
      <a href="/profile" class="me-3">Profile</a>
      <a href="/articles" class="me-3">Articles</a>
      <a href="/contact">Contact</a>
    </div>
  </div>
</nav>

<!-- 🔥 PROFILE -->
<div class="profile-box">

    <img src="{{ asset('images/jemacans.PNG') }}" class="profile-img">

    <h3>Najma Qodryan Fatiha</h3>
    <p>Mahasiswa Teknologi Informasi</p>

    <hr>

    <p><b>📍 Alamat:</b> Bawen</p>
    <p><b>🎓 Universitas:</b> UINSAGA</p>

</div>

<!-- 🔥 FOOTER -->
<footer class="text-center p-3">
    ©️ 2026 Najma Fatiha
</footer>

</body>
</html>