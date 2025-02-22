@extends('layouts.homepage')

@section('title', 'Profile - ' . $user->name)

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">

                <!-- Profile Card -->
                <div class="card shadow-lg mb-4 border-3">
                    <div class="card-header bg-dark text-white text-center border-3">
                        <h3 class="fw-bold mb-0">{{ __('User Profile') }}</h3>
                    </div>
                    <div class="card-body">
                        <!-- Profile Picture Section -->
                        <div class="text-center mb-5">
                            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/DefaultPicture.jpg') }}"
                                alt="Profile Picture" class="profile-img border border-dark-subtle " data-bs-toggle="modal"
                                data-bs-target="#profilePicModal">
                        </div>

                        <!-- User Info Section -->
                        <div class="text-center mb-4">
                            <h4 class="fw-bold">{{ $user->name }}</h4>
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                            <p class="text-muted">{{ $user->phone ?? 'Phone number not provided' }}</p>
                        </div>

                        <!-- Personal Info Section -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p><strong>Birthdate:</strong>
                                    {{ $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('F j, Y') : 'Not provided' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Gender:</strong>
                                    {{ ucfirst($user->gender ?? 'Not provided') }}
                                </p>
                            </div>
                        </div>

                        <!-- Location Info Section -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p><strong>Province:</strong> {{ $user->province ?? 'Not provided' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>City:</strong> {{ $user->city ?? 'Not provided' }}</p>
                            </div>
                        </div>

                        <!-- Edit Profile Button -->
                        <div class="text-center">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary border-pill py-2 px-4 w-100">Edit
                                Profile</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Profile Picture Modal -->
    <div class="modal fade" id="profilePicModal" tabindex="-1" aria-labelledby="profilePicModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/DefaultPicture.jpg') }}"
                        alt="Profile Picture" class="d-block w-100 border border-dark-subtle" />
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.05);
        }

        .card-header {
            background-color: #343a40;
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 2rem;
        }

        .btn-primary {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
@endpush
