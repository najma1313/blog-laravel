@extends('layouts.main')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card border-0 shadow-lg p-4" style="background-color: #3d0a0a; color: white; width: 100%; max-width: 400px; border-radius: 20px;">
        <div class="card-body">
            <h3 class="text-center fw-bold mb-2">LOGIN</h3>
            <p class="text-center text-white-50 small mb-4">Please login to manage archives</p>

            {{-- Alert jika salah password/email --}}
            @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show bg-danger text-white border-0 small" role="alert">
                    {{ session('loginError') }}
                </div>
            @endif

            {{-- Alert jika baru sukses register account --}}
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0 small" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- FORM ACTION DIUBAH KE ROUTE YANG PASTI --}}
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" autofocus required style="border-radius: 10px;">
                    @error('email')
                        <div class="invalid-feedback text-white-50 small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label small fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required style="border-radius: 10px;">
                </div>

                <button type="submit" class="btn w-100 fw-bold py-2 text-white" style="background-color: #721c24; border-radius: 10px; border: 1px solid rgba(255,255,255,0.2);">
                    Login
                </button>
            </form>

            <div class="text-center mt-3">
                Don't have an account? <a href="{{ route('register') }}" class="small text-decoration-none" style="color: #ff6b6b !important; font-weight: 500;">Register</a>
            </div>
        </div>
    </div>
</div>

<style>
    body { background-color: #ffffff !important; }
    .form-control:focus {
        border-color: #721c24;
        box-shadow: 0 0 0 0.25rem rgba(114, 28, 36, 0.25);
    }
</style>
@endsection