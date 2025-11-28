@extends('layouts.app')

@section('title', 'Login - VERTEX')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0" style="background: rgba(255, 255, 255, 0.95); border-radius: 15px;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark">Welcome Back!</h2>
                        <p class="text-muted">Login to your VERTEX account</p>
                    </div>

                    <form method="POST" action="{{ route('login.process') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-dark">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Enter your email" style="border-radius: 10px;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-dark">Password</label>
                            <input type="password" id="password" name="password" required class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Enter your password" style="border-radius: 10px;">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-lg w-100 text-white fw-semibold" style="background: #145e5c; border-radius: 10px; padding: 12px;">Login</button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="mb-0 text-muted">Don't have an account? <a href="{{ route('register') }}" class="fw-semibold text-decoration-none" style="color: #145e5c;">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection