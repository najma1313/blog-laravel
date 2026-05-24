@extends('layouts.main')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card border-0 shadow-lg p-4" style="background-color: #3d0a0a; color: white; width: 100%; max-width: 400px; border-radius: 20px;">
        <div class="card-body">
            <h3 class="text-center fw-bold mb-2">REGISTER</h3>
            <p class="text-center text-white-50 small mb-4">Create a new account to manage archives</p>

            <form action="/register" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label small fw-semibold">Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required style="border-radius: 10px;">
                    @error('name')
                        <div class="invalid-feedback text-white-50 small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required style="border-radius: 10px;">
                    @error('email')
                        <div class="invalid-feedback text-white-50 small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label small fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required style="border-radius: 10px;">
                    @error('password')
                        <div class="invalid-feedback text-white-50 small">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn w-100 fw-bold py-2 text-white" style="background-color: #721c24; border-radius: 10px; border: 1px solid rgba(255,255,255,0.2);">
                    Register Account
                </button>
            </form>
            
            <div class="text-center mt-3">
                Already have an account? <a href="/login" class="small text-decoration-none" style="color: #f8b4b4 !important; font-weight: 500;">Login</a>
            </div>
        </div>
    </div>
</div>
@endsection