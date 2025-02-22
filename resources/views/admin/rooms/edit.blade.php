@extends('layouts.admin')

@section('title', 'Edit Room')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">

            <!-- Edit Room Form -->
            <div class="card mb-4">
                <div class="card-header">Edit Room Details</div>
                <div class="card-body">
                    <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Room Number -->
                        <div class="mb-3">
                            <label for="roomNumber" class="form-label">Room Number</label>
                            <input type="text" class="form-control" id="roomNumber" name="room_number"
                                value="{{ old('room_number', $room->room_number) }}" required />
                        </div>

                        <!-- Room Type -->
                        <div class="mb-3">
                            <label for="roomType" class="form-label">Room Type</label>
                            <input type="text" class="form-control" id="roomType" name="room_type"
                                value="{{ old('room_type', $room->room_type) }}" required />
                        </div>

                        <!-- Room Rate -->
                        <div class="mb-3">
                            <label for="roomRate" class="form-label">Room Rate</label>
                            <input type="number" class="form-control" id="roomRate" name="room_rate"
                                value="{{ old('room_rate', $room->rate_per_night) }}" required />
                        </div>

                        <!-- Room Description -->
                        <div class="mb-3">
                            <label for="roomDescription" class="form-label">Room Description</label>
                            <textarea class="form-control" id="roomDescription" name="room_description" rows="3" required>{{ old('room_description', $room->description) }}</textarea>
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label for="profilePicture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profilePicture" name="profile_picture"
                                accept="image/*" />
                            @if ($room->profile_picture)
                                <div class="mt-2">
                                    <label>Current Profile Picture:</label>
                                    <img src="{{ asset('storage/' . $room->profile_picture) }}" alt="Profile Picture"
                                        width="100">
                                </div>
                            @endif
                        </div>

                        <!-- Gallery Photos -->
                        <div class="mb-3">
                            <label for="gallery" class="form-label">Gallery Photos</label>
                            <div id="galleryContainer">
                                @if ($room->gallery)
                                    @foreach (json_decode($room->gallery) as $image)
                                        <div class="input-group mb-2">
                                            <!-- Hidden input to store current gallery image path -->
                                            <input type="hidden" name="old_gallery[]" value="{{ $image }}">
                                            <input type="file" class="form-control" name="gallery[]" accept="image/*" />
                                            <button type="button" class="btn btn-danger removeGallery">Remove</button>
                                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image" width="50"
                                                class="me-2">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2">
                                        <input type="file" class="form-control" name="gallery[]" accept="image/*" />
                                        <button type="button" class="btn btn-danger removeGallery"
                                            style="display: none;">Remove</button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-primary" id="addGalleryBtn">Add Another Photo</button>
                        </div>


                        <!-- Room Features-->
                        <div class="mb-3">
                            <label for="roomFeatures" class="form-label">Room Features / Amenities</label>
                            <div id="featuresContainer">
                                @if ($room->features)
                                    @foreach (json_decode($room->features) as $feature)
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="features[]"
                                                value="{{ $feature }}" />
                                            <button type="button" class="btn btn-danger removeFeature">Remove</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="features[]"
                                            placeholder="Enter feature (e.g., Wi-Fi, AC)" />
                                        <button type="button" class="btn btn-danger removeFeature"
                                            style="display: none;">Remove</button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-primary" id="addFeatureBtn">Add Another Feature</button>
                            <small class="form-text text-muted">Add multiple features separated by commas (e.g., Wi-Fi, AC,
                                Sea View).</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Room</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script>
            $(document).ready(function() {


                // Add a new feature input field
                $('#addFeatureBtn').click(function() {
                    $('#featuresContainer').append(`
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="features[]" placeholder="Enter feature (e.g., Wi-Fi, AC)" />
                            <button type="button" class="btn btn-danger removeFeature">Remove</button>
                        </div>
                    `);
                });

                // Remove a feature input field
                $('#featuresContainer').on('click', '.removeFeature', function() {
                    $(this).closest('.input-group').remove();
                });

                // Add a new gallery photo input field
                $('#addGalleryBtn').click(function() {
                    $('#galleryContainer').append(`
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" name="gallery[]" accept="image/*" />
                            <button type="button" class="btn btn-danger removeGallery">Remove</button>
                        </div>
                    `);
                });

                // Remove a gallery photo input field
                $('#galleryContainer').on('click', '.removeGallery', function() {
                    $(this).closest('.input-group').remove();
                });
            });
        </script>
    @endpush
@endsection
