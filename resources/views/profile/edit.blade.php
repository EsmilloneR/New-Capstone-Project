@extends('layouts.homepage')

@section('title', 'Edit Profile')

@push('styles')
    <style>
        .profile-img-wrapper {
            position: relative;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.1);
            cursor: pointer;
        }

        .no-img {
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 50%;
            font-size: 14px;
            color: #6c757d;
        }

        .form-select,
        .form-control {
            border-radius: 30px;
        }

        .btn {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card-header {
            border-radius: 10px 10px 0 0;
        }
    </style>
@endpush

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">

                <!-- Profile Edit Card -->
                <div class="card shadow-sm mb-4 rounded-lg">
                    <div class="card-header text-center rounded-top">
                        <h4 class="fw-bold mb-0">Update Profile Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Profile Picture Section -->
                            <div class="text-center mb-5">
                                <label for="profilePicture" class="form-label fw-bold">Profile Picture</label>
                                <div class="position-relative">
                                    <input type="file" class="form-control-file" id="profilePicture"
                                        name="profile_picture" />
                                    <div class="profile-img-wrapper">
                                        @if (auth()->user()->profile_picture)
                                            <img id="profileImgPreview"
                                                src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                                alt="Profile Picture" class="profile-img" />
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Full Name -->
                            <div class="mb-4">
                                <label for="profileName" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="profileName" name="name" value="{{ old('name', auth()->user()->name) }}" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="profileEmail" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="profileEmail" name="email" value="{{ old('email', auth()->user()->email) }}" d />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="mb-4">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Birthdate -->
                            <div class="mb-4">
                                <label for="birthdate" class="form-label">Birthdate</label>
                                <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                    id="birthdate" name="birthdate"
                                    value="{{ old('birthdate', auth()->user()->birthdate ? auth()->user()->birthdate->toDateString() : '') }}" />
                                @error('birthdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Gender -->
                            <div class="mb-4">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                    name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male"
                                        {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female"
                                        {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="lgbtq+"
                                        {{ old('gender', auth()->user()->gender) == 'lgbtq+' ? 'selected' : '' }}>LGBTQ+
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Province -->
                            <div class="mb-4">
                                <label for="province" class="form-label">Province</label>
                                <select class="form-select @error('province') is-invalid @enderror" id="province"
                                    name="province">
                                    <option value="">Select Province</option>
                                    <option value="Province1"
                                        {{ old('province', auth()->user()->province) == 'Province1' ? 'selected' : '' }}>
                                        Province 1</option>
                                    <option value="Province2"
                                        {{ old('province', auth()->user()->province) == 'Province2' ? 'selected' : '' }}>
                                        Province 2</option>
                                </select>
                                @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="mb-4">
                                <label for="city" class="form-label">City</label>
                                <select class="form-select @error('city') is-invalid @enderror" id="city"
                                    name="city">
                                    <option value="">Select City</option>
                                    <option value="City1"
                                        {{ old('city', auth()->user()->city) == 'City1' ? 'selected' : '' }}>City 1
                                    </option>
                                    <option value="City2"
                                        {{ old('city', auth()->user()->city) == 'City2' ? 'selected' : '' }}>City 2
                                    </option>
                                </select>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Save Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary rounded-pill py-2 w-100">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password Section -->
                <div class="card shadow-sm mb-4 rounded-lg">
                    <div
                        class="card-header bg-gradient-to-r from-yellow-500 to-yellow-600 text-white text-center rounded-top">
                        <h4 class="fw-bold mb-0">Update Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="currentPassword" class="form-label">Current Password</label>
                                <input type="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    id="currentPassword" name="current_password" />
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="newPassword" name="password" />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="confirmPassword" name="password_confirmation" />
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-warning rounded-pill py-2 w-100">Update
                                    Password</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Account Section -->
                <div class="card shadow-sm mb-4 rounded-lg">
                    <div class="card-header bg-gradient-to-r from-red-500 to-red-600 text-white text-center rounded-top">
                        <h4 class="fw-bold mb-0">Delete Account</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-danger text-center mb-4">
                            Warning: Once you delete your account, there is no going back. Please be certain.
                        </p>
                        <form action="{{ route('profile.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="mb-4">
                                <label for="deletePassword" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="deletePassword" name="password" />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-danger rounded-pill py-2 w-100">Delete My
                                    Account</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        // Profile picture preview
        $('#profilePicture').on('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profileImgPreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endpush
