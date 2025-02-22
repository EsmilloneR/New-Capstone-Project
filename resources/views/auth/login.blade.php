@extends('layouts.login_register')

@section('title', 'Login')

@section('content')
    <div class="auth-bg d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="auth-container card border-0 shadow-sm p-4" style="width: 100%; max-width: 380px;">
            <h3 class="text-center header-text">Welcome Back to Our Hotel</h3>
            <p class="text-center" style="color: #666;">Book your stay, enjoy luxury.</p>

            <form action="{{ route('login') }}" method="post">
                @csrf

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="form-label" style="color: #333;">Email Address</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                        placeholder="Enter your email" required aria-label="Email Address" />
                    @error('email')
                        <p class="error-text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <label for="loginPassword" class="form-label" style="color: #333;">Password</label>
                    <input type="password" class="form-control form-control-lg" id="loginPassword" name="password"
                        placeholder="Enter your password" required aria-label="Password" />
                    @error('password')
                        <p class="error-text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-dark btn-lg">Login</button>
                </div>
            </form>

            <!-- Forgot Password Link -->
            <div class="text-center mb-3">
                <a href="{{ route('password.request') }}" class="text-decoration-none text-muted">Forgot Password?</a>
            </div>

            <!-- Additional Action Buttons -->
            <div class="text-center">
                <a href="{{ url('/') }}" class="btn btn-outline-dark mb-2">Back to Homepage</a>
            </div>
            <div class="text-center">
                <a href="{{ route('register') }}" class="btn btn-outline-dark">Create an Account</a>
            </div>
        </div>
    </div>
@endsection
