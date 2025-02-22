@extends('layouts.admin')

@section('title', 'Edit Customer')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Edit Customer</h2>

            <!-- Edit Form -->
            <div class="card shadow-lg mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Profile Picture Section -->
                        <div class="form-group text-center mb-3">
                            <label for="profile_picture">Profile Picture</label><br>
                            @if ($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                                    class="border border-primary rounded-circle" width="150" height="150"
                                    style="object-fit: cover; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            @else
                                <div class="profile-picture-placeholder p-3 border rounded-circle"
                                    style="border-color: #ddd;">
                                    <p class="text-muted mb-0">No profile picture uploaded</p>
                                </div>
                            @endif
                            <div class="mt-2">
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                            </div>
                            @error('profile_picture')
                                <p class="text-danger small mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Customer Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <p class="text-danger small mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <p class="text-danger small mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <p class="text-danger small mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @if (Auth::user()->role == 'super-admin')
                            <!-- Role -->
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                    <option value="guest" {{ old('role', $user->role) === 'guest' ? 'selected' : '' }}>
                                        Guest</option>
                                </select>
                                @error('role')
                                    <p class="text-danger small mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif


                        <!-- Gender -->
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>
                                    Male</option>
                                <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>
                                    Female</option>
                                <option value="lgbtq+" {{ old('gender', $user->gender) === 'lgbtq+' ? 'selected' : '' }}>
                                    LGBTQ+</option>
                            </select>
                            @error('gender')
                                <p class="text-danger small mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Birthdate -->
                        <div class="form-group mb-2">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate"
                                value="{{ old('birthdate', $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->toDateString() : '') }}">
                            @error('birthdate')
                                <p class="text-danger small mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        <a href="{{ route('admin.users.guests.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Hover Effect on Card */
        .card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Profile Picture Placeholder Styling */
        .profile-picture-placeholder {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            color: #bbb;
            font-size: 14px;
            text-align: center;
        }

        /* Hover Effect on Button */
        button:hover {
            background-color: #d78b19;
            /* Darker shade of primary color */
            color: white;
        }
    </style>
@endpush
