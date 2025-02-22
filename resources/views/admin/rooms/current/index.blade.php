@extends('layouts.admin')

@section('title', 'Current Rooms')

@section('content')
    <div class="main-content">
        <div class="container-fluid">

            <div class="role-section mb-4">
                <h5>Current Rooms</h5>
                <div class="card mb-3">
                    <div class="card-body p-3">
                        <table class="table table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Gallery</th>
                                    <th scope="col">Features</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>

                                            <div class="d-flex align-items-center">
                                                @if ($room->profile_picture)
                                                    <img src="{{ asset('storage/' . $room->profile_picture) }}"
                                                        alt="Profile Picture" style="width: 45px; height: 45px">
                                                @else
                                                    No image
                                                @endif
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">{{ $room->room_type }}</p>
                                                    <p class="text-muted mb-0">
                                                        ₱{{ number_format($room->rate_per_night, 2) }}
                                                    </p>
                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                            @if ($room->gallery)
                                                @php
                                                    $galleryImages = json_decode($room->gallery);
                                                @endphp
                                                @foreach ($galleryImages as $image)
                                                    <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image"
                                                        width="50" class="me-2">
                                                @endforeach
                                            @else
                                                No images
                                            @endif
                                        </td>
                                        <td>
                                            @if ($room->features)
                                                <ul class="list-unstyled">
                                                    @php
                                                        $features = json_decode($room->features);
                                                    @endphp
                                                    @foreach ($features as $feature)
                                                        <li>{{ $feature }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                No features
                                            @endif
                                        </td>
                                        <td>{{ \Str::limit($room->description, 50) }}</td>
                                        <td class="actions">
                                            <a href="{{ route('admin.rooms.edit', $room->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST"
                                                style="display: inline;"
                                                onsubmit="return confirm('Are you sure you want to delete this room?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
