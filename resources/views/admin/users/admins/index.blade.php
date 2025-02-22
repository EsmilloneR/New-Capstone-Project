@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')
    <x-users>
        <!-- Search Bar -->
        <form action="{{ route('admin.users.admins.index') }}" method="GET" class="mb-3" style="margin-right:70%">
            <div class="input-group rounded">
                <input type="text" class="form-control rounded" name="search" value="{{ $search }}"
                    placeholder="Search users by name, email or phone" aria-describedby="search-addon">
                <button class="btn btn-outline-dark" type="submit"><i class='bx bx-search-alt-2 '></i></button>
            </div>
        </form>

        <!-- Admins Section -->
        <div class="role-section mb-4">
            <h5>Admins</h5>
            <div class="card mb-3">
                <div class="card-body p-3">
                    <!-- Table for Admins -->
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $index => $admin)
                                    <tr>
                                        <th scope="row">
                                            {{ $index + 1 + ($admins->currentPage() - 1) * $admins->perPage() }}
                                        </th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($admin->profile_picture)
                                                    <img src="{{ asset('storage/' . $admin->profile_picture) }}"
                                                        alt="Profile Picture" style="width: 45px; height: 45px"
                                                        class="rounded-circle" loading="lazy">
                                                @else
                                                    <div class="profile-picture-placeholder">
                                                        <img src="{{ asset('images/DefaultPicture.jpg') }}"
                                                            alt="Profile Picture" alt=""
                                                            style="width: 45px; height: 45px" class="rounded-circle"
                                                            loading="lazy">
                                                    </div>
                                                @endif
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">{{ $admin->name }}</p>
                                                    <p class="text-muted mb-0">{{ $admin->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($admin->phone)
                                                <p class="fw-medium mb-auto">{{ $admin->phone }}</p>
                                            @else
                                                <p class="text-muted mb-auto"><span
                                                        class="badge rounded-pill text-bg-info">Not provided</span></p>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-auto">
                                                {{ ucfirst($admin->role) }}</p>
                                        </td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <div class="d-flex gap-3 align-items-center">
                                                <a href="{{ route('admin.users.show', $admin->id) }}"><img
                                                        src="{{ asset('images/svg/showuser.svg') }}"
                                                        class="svg-link"></a></a>
                                                <a href="{{ route('admin.users.edit', $admin->id) }}"><img
                                                        src="{{ asset('images/svg/edit.svg') }}" class="svg-link"></a>

                                                <!-- Delete Form -->
                                                <form action="{{ route('admin.users.delete', $admin->id) }}" method="POST"
                                                    style="display:inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this admin?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0">
                                                        <img src="{{ asset('images/svg/deleteuser.svg') }}"
                                                            class="svg-link" alt="Delete Admin">
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $admins->appends(['search' => $search])->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </x-users>

@endsection
