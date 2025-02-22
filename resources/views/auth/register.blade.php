@extends('layouts.login_register')

@section('title', 'Register')

@section('content')

    <div class="auth-bg d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="auth-container card border-0 shadow-sm p-4" style="width: 100%; max-width: 380px;">
            <h3 class="text-center header-text">Create an Account</h3>
            <p class="text-center" style="color: #666;">Join us for an unforgettable stay!</p>

            <form action="{{ route('register') }}" method="post">
                @csrf

                <!-- Name Input -->
                <div class="mb-4">
                    <label for="name" class="form-label" style="color: #333;">Full Name</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name"
                        placeholder="Enter your full name" required aria-label="Full Name" />
                    @error('name')
                        <p class="error-text text-danger">{{ $message }}</p>
                    @enderror
                </div>

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
                    <label for="password" class="form-label" style="color: #333;">Password</label>
                    <input type="password" class="form-control form-control-lg" id="password" name="password"
                        placeholder="Create a password" required aria-label="Password" />
                    @error('password')
                        <p class="error-text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Input -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label" style="color: #333;">Confirm Password</label>
                    <input type="password" class="form-control form-control-lg" id="password_confirmation"
                        name="password_confirmation" placeholder="Confirm your password" required
                        aria-label="Confirm Password" />
                </div>

                <!-- Submit Button -->
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-dark btn-lg">Register</button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="text-center mb-3">
                <p class="text-muted">Already have an account? <a href="{{ route('login') }}"
                        class="text-decoration-none">Login</a></p>
            </div>

            <!-- Additional Action Button -->
            <div class="text-center">
                <a href="{{ url('/') }}" class="btn btn-outline-dark mb-2">Back to Homepage</a>
            </div>
        </div>
    </div>
@endsection
