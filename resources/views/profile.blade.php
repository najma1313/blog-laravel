<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Najma</title>
    
    <!-- CSS External -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #331307;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            padding: 20px 0;
        }

        .navbar-brand {
            font-size: 1.1rem;
            color: white !important;
        }

        .nav-link-custom {
            color: rgba(255, 255, 255, 0.8) !important;
            font-size: 0.9rem;
            margin-left: 20px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .nav-link-custom:hover, .nav-link-custom.active {
            color: white !important;
            font-weight: bold;
        }

        /* Layout Wrapper */
        .main-wrapper {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Profile Card */
        .profile-card {
            width: 100%;
            max-width: 420px;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .profile-img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #5d2510;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.05);
        }

        .name {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .role {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 30px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Info Details */
        .info-list {
            text-align: left;
            font-size: 14px;
            line-height: 2;
            color: rgba(255, 255, 255, 0.9);
        }

        .info-item {
            display: flex;
            margin-bottom: 8px;
        }

        .info-label {
            width: 100px;
            font-weight: bold;
            color: rgba(255, 255, 255, 0.6);
        }

        .info-divider {
            margin-right: 15px;
        }

        .info-value {
            flex: 1;
        }

        /* --- BAGIAN YANG DIUBAH --- */
        .info-value a {
            color: white; /* Tulisan email sekarang berwarna putih */
            text-decoration: none;
            transition: opacity 0.3s ease;
        }
        
        .info-value a:hover {
            text-decoration: underline;
            opacity: 0.8; /* Memberikan efek sedikit pudar saat di-hover */
        }
        /* -------------------------- */

        /* Social Icons */
        .social-links {
            margin-top: 35px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: center;
            gap: 25px;
        }

        .social-icon {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            color: white; /* Mengubah hover icon jadi putih juga agar seragam */
            transform: translateY(-5px);
        }

        footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.4);
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold" href="#">MyBlog</a>
            <div class="d-flex align-items-center">
                <a href="/" class="nav-link-custom">Home</a>
                <a href="/profile" class="nav-link-custom active">Profile</a>
                <a href="/articles" class="nav-link-custom">Articles</a>
                <a href="/contact" class="nav-link-custom">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-wrapper">
        <div class="profile-card">
            <!-- Profile Image -->
            <img src="{{ asset('images/jemoy.png') }}" alt="Foto Najma Qodryan Fatiha" class="profile-img">
            
            <div class="name">Najma Qodryan Fatiha</div>
            <div class="role">Mahasiswa Teknologi Informasi</div>

            <div class="info-list">
                <div class="info-item">
                    <span class="info-label">Alamat</span>
                    <span class="info-divider">:</span>
                    <span class="info-value">Bawen, Jawa Tengah</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Universitas</span>
                    <span class="info-divider">:</span>
                    <span class="info-value">UIN Salatiga</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Skill</span>
                    <span class="info-divider">:</span>
                    <span class="info-value">Bootstrap, Laravel</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-divider">:</span>
                    <span class="info-value">
                        <a href="mailto:najmafthaa@gmail.com">najmafthaa@gmail.com</a>
                    </span>
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="social-links">
                <a href="https://github.com" class="social-icon" target="_blank" title="GitHub">
                    <i class="fab fa-github"></i>
                </a>
                <a href="https://linkedin.com" class="social-icon" target="_blank" title="LinkedIn">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="https://instagram.com" class="social-icon" target="_blank" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        &copy; 2026 Najma Fatiha | Built with Laravel & Bootstrap
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>