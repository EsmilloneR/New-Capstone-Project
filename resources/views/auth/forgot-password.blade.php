@extends('layouts.login_register')

@section('title', 'Forgot Password')

@section('content')
    <div class="auth-bg d-flex justify-content-center align-items-center"
        style="min-height: 100vh; background-color: #f9f9f9;">
        <div class="auth-container card border-0 shadow-sm p-4" style="width: 100%; max-width: 380px; border-radius: 8px;">
            <h3 class="text-center mb-4" style="color: #333;">Forgot Your Password?</h3>

            <p class="text-center text-muted mb-4" style="color: #555;">No worries! Just enter your email and we'll send you a
                link to reset your password.</p>

            <form action="{{ route('password.email') }}" method="post">
                @csrf

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="form-label" style="color: #555;">Email Address</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                        placeholder="Enter your email" required />
                    @error('email')
                        <p class="text-danger small mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-dark btn-lg">Send Reset Link</button>
                </div>
            </form>

            <!-- Back to Login Link -->
            <div class="text-center mb-3">
                <p class="text-muted">Remember your password? <a href="{{ route('login') }}"
                        class="text-decoration-none">Login</a></p>
            </div>

            <!-- Back to Homepage Button -->
            <div class="text-center">
                <a href="{{ url('/') }}" class="btn btn-outline-dark mb-2">Back to Homepage</a>
            </div>
        </div>
    </div>
@endsection
