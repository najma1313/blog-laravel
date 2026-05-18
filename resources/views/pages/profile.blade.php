@extends('layouts.main')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="profile-card-center shadow-lg">
        <div class="text-center mb-4">
            <div class="profile-img-container">
                {{-- Ganti asset('path/foto.jpg') dengan path foto kamu --}}
                <img src="{{ asset('images/jemoy.png') }}" alt="Najma Qodryan Fatiha" class="img-profile-main">
            </div>
            <h3 class="fw-bold mt-3 mb-1 text-white">Najma Qodryan Fatiha</h3>
            <p class="text-white-50 small">Mahasiswa Teknologi Informasi</p>
        </div>

        <div class="profile-details">
            <div class="detail-item">
                <span class="label">Alamat</span>
                <span class="separator">:</span>
                <span class="value">Bawen, Jawa Tengah</span>
            </div>
            <div class="detail-item">
                <span class="label">Universitas</span>
                <span class="separator">:</span>
                <span class="value">UIN Salatiga</span>
            </div>
            <div class="detail-item">
                <span class="label">Skill</span>
                <span class="separator">:</span>
                <span class="value">Bootstrap, Laravel</span>
            </div>
            <div class="detail-item">
                <span class="label">Email</span>
                <span class="separator">:</span>
                <span class="value text-truncate">najmalthaa@gmail.com</span>
            </div>
        </div>

        <hr class="my-4 opacity-25 bg-light">

        <div class="social-links-bottom text-center">
            <a href="https://github.com/najma1313" class="mx-2"><i class="bi bi-github"></i></a>
            <a href="#" class="mx-2"><i class="bi bi-linkedin"></i></a>
            <a href="#" class="mx-2"><i class="bi bi-instagram"></i></a>
        </div>
    </div>
</div>

<style>
    /* Mengubah background body */
    body {
        background-color: #ffffff !important;
    }

    /* Card Styling (Warna Maroon Gelap ) */
    .profile-card-center {
        background-color: #3d0a0a; /* Maroon gelap */
        color: white;
        width: 100%;
        max-width: 450px;
        border-radius: 25px;
        padding: 40px;
        position: relative;
        transition: transform 0.3s ease;
    }

    .profile-card-center:hover {
        transform: translateY(-10px);
    }

    /* Profile Image Styling */
    .profile-img-container {
        width: 130px;
        height: 150px;
        margin: 0 auto;
        border-radius: 15px;
        overflow: hidden;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .img-profile-main {
        width: 100%;
        height: 100%;
        object-fit: cover; 
    }

    /* Detail Item Styling (Layout Tabel) */
    .profile-details {
        margin-top: 25px;
    }

    .detail-item {
        display: flex;
        margin-bottom: 12px;
        font-size: 0.95rem;
    }

    .detail-item .label {
        width: 100px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
    }

    .detail-item .separator {
        width: 20px;
        color: rgba(255, 255, 255, 0.5);
    }

    .detail-item .value {
        flex: 1;
        color: rgba(255, 255, 255, 0.8);
    }

    /* Social Links Styling */
    .social-links-bottom a {
        color: white;
        font-size: 1.3rem;
        opacity: 0.7;
        transition: 0.3s;
        text-decoration: none;
    }

    .social-links-bottom a:hover {
        opacity: 1;
        transform: scale(1.2);
    }

    hr {
        border-top: 1px solid white;
    }
</style>
@endsection