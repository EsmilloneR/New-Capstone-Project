@extends('layouts.admin')

@section('title', 'User Profile - ' . $user->name)

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <h2>User Profile</h2>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <!-- Profile Picture Section -->
                        <div class="col-md-4 text-center">
                            @if ($user->profile_picture)
                                <!-- Square profile picture with a border -->
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                                    class="border border-primary rounded-3" width="150" height="150"
                                    style="object-fit: cover;">
                            @else
                                <!-- Default Profile Picture if none uploaded -->
                                <div class="profile-picture-placeholder">
                                    <p>No profile picture uploaded</p>
                                </div>
                            @endif
                        </div>

                        <!-- User Information Section -->
                        <div class="col-md-8">
                            <h4 class="text-primary">{{ $user->name }}</h4>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Phone:</strong> {{ $user->phone ?? 'Not provided' }}</p>
                            <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                            <p><strong>Gender:</strong> {{ ucfirst(string: $user->gender ?? 'Not provided') }}</p>
                            <!-- Gender added -->
                            <p><strong>Birthdate:</strong>
                                {{ $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('F j, Y') : 'Not provided' }}
                            </p>
                            <p><strong>Joined:</strong> {{ $user->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>

                    <hr>

                    <!-- Buttons to Edit or Delete User -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit User</a>
                        <a href="{{ route('admin.users.delete', $user->id) }}" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this user?')">Delete User</a>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
