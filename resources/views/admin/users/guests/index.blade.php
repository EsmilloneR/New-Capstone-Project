@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')

    <x-users>
        <!-- Search Bar -->
        <form action="{{ route('admin.users.guests.index') }}" method="GET" class="mb-3" style="margin-right:70%">
            <div class="input-group">
                <input type="text" class="form-control" name="search" value="{{ $search }}"
                    placeholder="Search users by name, email or phone">
                <button class="btn btn-outline-dark" type="submit"><i class='bx bx-search-alt-2'></i></button>
            </div>
        </form>

        <!-- Guests Section -->
        <div class="mb-4">
            <h5>Guests</h5>
            <div class="card mb-3">
                <div class="card-body p-3">
                    <!-- Table for Guests -->
                    <div class="table-responsive">
                        <table class="table table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guests as $index => $guest)
                                    <tr>
                                        <th scope="row">
                                            {{ $index + 1 + ($guests->currentPage() - 1) * $guests->perPage() }}
                                        </th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($guest->profile_picture)
                                                    <img src="{{ asset('storage/' . $guest->profile_picture) }}"
                                                        alt="Profile Picture" alt=""
                                                        style="width: 45px; height: 45px" class="rounded-circle"
                                                        loading="lazy">
                                                @else
                                                    <div class="profile-picture-placeholder">
                                                        <img src="{{ asset('images/DefaultPicture.jpg') }}"
                                                            alt="Profile Picture" alt=""
                                                            style="width: 45px; height: 45px" class="rounded-circle"
                                                            loading="lazy">
                                                    </div>
                                                @endif
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">{{ $guest->name }}</p>
                                                    <p class="text-muted mb-0">{{ $guest->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($guest->phone)
                                                <p class="fw-medium mb-auto">{{ $guest->phone }}</p>
                                            @else
                                                <p class="text-muted mb-auto"><span
                                                        class="badge rounded-pill text-bg-info">Not provided</span></p>
                                            @endif
                                        </td>

                                        <td>
                                            <!-- Action Buttons -->
                                            <div class="d-flex gap-3 align-items-center">
                                                <a href="{{ route('admin.users.show', $guest->id) }}" class=""><img
                                                        src="{{ asset('images/svg/showuser.svg') }}" class="svg-link"></a>
                                                <a href="{{ route('admin.users.edit', $guest->id) }}"><img
                                                        src="{{ asset('images/svg/edit.svg') }}" class="svg-link"></a>

                                                <!-- Delete Form -->
                                                <form action="{{ route('admin.users.delete', $guest->id) }}" method="POST"
                                                    style="display:inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0">
                                                        <img src="{{ asset('images/svg/deleteuser.svg') }}"
                                                            class="svg-link" alt="Delete User">
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $guests->appends(['search' => $search])->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </x-users>



@endsection
