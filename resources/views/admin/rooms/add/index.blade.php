@extends('layouts.admin')

@section('title', 'Add Rooms')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="mb-4">
                <div class="card mb-3">
                    <div class="card-body p-3">
                        <form
                            action="{{ isset($room) ? route('admin.rooms.update', $room->id) : route('admin.rooms.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($room))
                                @method('PUT')
                            @endif

                            <!-- Room Number -->
                            <div class="mb-3">
                                <label for="roomNumber" class="form-label">Room Number</label>
                                <input type="text" class="form-control" id="roomNumber" name="room_number"
                                    value="{{ old('room_number', $room->room_number ?? '') }}" required />
                            </div>

                            <!-- Room Type -->
                            <div class="mb-3">
                                <label for="roomType" class="form-label">Room Type</label>
                                <input type="text" class="form-control" id="roomType" name="room_type"
                                    value="{{ old('room_type', $room->room_type ?? '') }}" required />
                            </div>

                            <!-- Room Rate -->
                            <div class="mb-3">
                                <label for="roomRate" class="form-label">Room Rate</label>
                                <input type="number" class="form-control" id="roomRate" name="room_rate"
                                    value="{{ old('room_rate', $room->rate_per_night ?? '') }}" required />
                            </div>

                            <!-- Room Description -->
                            <div class="mb-3">
                                <label for="roomDescription" class="form-label">Room Description</label>
                                <textarea class="form-control" id="roomDescription" name="room_description" rows="3" required>{{ old('room_description', $room->description ?? '') }}</textarea>
                            </div>

                            <!-- Profile Picture -->
                            <div class="mb-3">
                                <label for="profilePicture" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="profilePicture" name="profile_picture"
                                    accept="image/*" />
                                @if (isset($room) && $room->profile_picture)
                                    <img src="{{ asset('storage/' . $room->profile_picture) }}" alt="Profile Picture"
                                        width="100" class="mt-2">
                                @endif
                            </div>

                            <!-- Gallery Photos -->
                            <div class="mb-3">
                                <label for="gallery" class="form-label">Gallery Photos</label>
                                <div id="galleryContainer">
                                    @if (old('gallery'))
                                        @foreach (old('gallery') as $galleryImage)
                                            <div class="input-group mb-2">
                                                <input type="file" class="form-control" name="gallery[]" accept="image/*"
                                                    value="{{ $galleryImage }}">
                                                <button type="button"
                                                    class="btn btn-danger removeGallery d-flex align-items-center"><img
                                                        src="{{ asset('images/svg/remove.svg') }}"
                                                        class="svg-link img-fluid">Remove</button>
                                            </div>
                                        @endforeach
                                    @elseif(isset($room) && $room->gallery)
                                        @php
                                            $galleryImages = json_decode($room->gallery);
                                        @endphp
                                        @foreach ($galleryImages as $galleryImage)
                                            <div class="input-group mb-2">
                                                <input type="file" class="form-control" name="gallery[]" accept="image/*"
                                                    value="{{ $galleryImage }}">
                                                <button type="button"
                                                    class="btn btn-danger removeGallery d-flex align-items-center"><img
                                                        src="{{ asset('images/svg/remove.svg') }}"
                                                        class="svg-link img-fluid ">Remove</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <input type="file" class="form-control" name="gallery[]" accept="image/*" />
                                            <button type="button"
                                                class="btn btn-danger removeGallery d-flex align-items-center"><img
                                                    src="{{ asset('images/svg/remove.svg') }}"
                                                    class="svg-link img-fluid">Remove</button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-primary" id="addGalleryBtn"><img
                                        src="{{ asset('images/svg/add.svg') }}" class="svg-link img-fluid"
                                        style="height: 25px; margin-right: 8px;"> Add Another Photo</button>
                            </div>

                            <!-- Room Features -->
                            <div class="mb-3">
                                <label for="roomFeatures" class="form-label">Room Features / Amenities</label>
                                <div id="featuresContainer">
                                    @if (old('features'))
                                        @foreach (old('features') as $feature)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="features[]"
                                                    value="{{ $feature }}" />
                                                <button type="button"
                                                    class="btn btn-danger removeFeature d-flex align-items-center"><img
                                                        src="{{ asset('images/svg/remove.svg') }}"
                                                        class="svg-link img-fluid">Remove</button>
                                            </div>
                                        @endforeach
                                    @elseif(isset($room) && $room->features)
                                        @php
                                            $features = json_decode($room->features);
                                        @endphp
                                        @foreach ($features as $feature)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="features[]"
                                                    value="{{ $feature }}" />
                                                <button type="button" class="btn btn-danger removeFeature"><img
                                                        src="{{ asset('images/svg/add.svg') }}"
                                                        class="svg-link img-fluid"
                                                        style="height: 25px; margin-right: 8px; color:white">
                                                    Remove</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="features[]"
                                                placeholder="Enter feature" />
                                            <button type="button"
                                                class="btn btn-danger removeFeature d-flex align-items-center"><img
                                                    src="{{ asset('images/svg/remove.svg') }}"
                                                    class="svg-link img-fluid">Remove</button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-primary d-flex align-items-center"
                                    id="addFeatureBtn"><img src="{{ asset('images/svg/add.svg') }}"
                                        class="svg-link img-fluid" style="height: 25px; margin-right: 8px;">Add
                                    Another
                                    Feature</button>
                            </div>

                            <button type="submit"
                                class="btn btn-primary">{{ isset($room) ? 'Update Room' : 'Add Room' }}</button>
                        </form>
                    </div>
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
                        <input type="text" class="form-control" name="features[]" placeholder="Enter feature" />
                        <button type="button" class="btn btn-danger removeFeature">Remove</button>
                    </div>
                `);
                });

                // Remove a feature input field
                $(document).on('click', '.removeFeature', function() {
                    $(this).closest('.input-group').remove();
                });

                // Add another gallery photo input field
                $('#addGalleryBtn').click(function() {
                    $('#galleryContainer').append(`
                    <div class="input-group mb-2">
                        <input type="file" class="form-control" name="gallery[]" accept="image/*" />
                        <button type="button" class="btn btn-danger removeGallery">Remove</button>
                    </div>
                `);
                });

                // Remove a gallery image input field
                $(document).on('click', '.removeGallery', function() {
                    $(this).closest('.input-group').remove();
                });
            });
        </script>
    @endpush
@endsection
