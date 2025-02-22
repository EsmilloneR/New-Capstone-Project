@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <h2>Settings</h2>

            <!-- General Settings Section -->
            <div class="card mb-4">
                <div class="card-header">General Settings</div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="siteTitle" class="form-label">Site Title</label>
                            <input type="text" class="form-control" id="siteTitle" value="Welcome to Paper Country Inn" />
                        </div>
                        <div class="mb-3">
                            <label for="siteDescription" class="form-label">Site Description</label>
                            <input type="text" class="form-control" id="siteDescription"
                                value="Where comfort meets tranquility. Your perfect getaway starts here." />
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>

            <!-- Account Settings Section -->
            <div class="card mb-4">
                <div class="card-header">Account Settings</div>
                <div class="card-body">
                    <form action="{{ route('admin.users.update', auth()->user()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Profile Picture Section -->
                        <div class="form-group text-center mb-3">
                            <label for="profile_picture">Profile Picture</label><br>
                            @if (auth()->user()->profile_picture)
                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture"
                                    class="border border-primary" width="150" height="150"
                                    style="object-fit: cover; border-radius: 0px;">
                            @else
                                <div class="profile-picture-placeholder">
                                    <p>No profile picture uploaded</p>
                                </div>
                            @endif
                            <div class="mt-2">
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                            </div>
                            @error('profile_picture')
                                <p class="text-danger small mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Admin Email -->
                        <div class="mb-3">
                            <label for="adminEmail" class="form-label">Admin Email</label>
                            <input type="email" class="form-control" id="adminEmail" name="email"
                                value="{{ old('email', auth()->user()->email) }}" required />
                            @error('email')
                                <p class="text-danger small mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Admin Password -->
                        <div class="mb-3">
                            <label for="adminPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="adminPassword" name="password" />
                            <p class="small text-muted">Leave blank if you don't want to change the password.</p>
                            @error('password')
                                <p class="text-danger small mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div class="mb-3">
                            <label for="passwordConfirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="passwordConfirmation"
                                name="password_confirmation" />
                            @error('password_confirmation')
                                <p class="text-danger small mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
