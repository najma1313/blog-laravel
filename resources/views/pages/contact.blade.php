@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-5">
                <h3 class="fw-bold mb-2 text-center" style="color: #800020;">Mari Terhubung</h3>
                <p class="text-muted text-center mb-4">Punya pertanyaan, proyek kolaborasi, atau sekadar ingin menyapa? Kirim pesanmu di bawah.</p>
                
                <form action="#" method="GET" onsubmit="alert('Fitur kirim pesan simulasi berhasil!'); return false;">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control rounded-3" required placeholder="Nama Anda">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" class="form-control rounded-3" required placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pesan</label>
                        <textarea class="form-control rounded-3" rows="4" required placeholder="Tulis pesanmu di sini..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-custom-maroon w-100 py-2.5 mt-2">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection