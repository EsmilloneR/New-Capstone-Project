@extends('layouts.homepage')

@section('title', 'Home')

@section('content')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content animate-fade-in">
            <h1 class="hero-title">Welcome to Paper Country Inn</h1>
            <p class="hero-description">Where comfort meets tranquility. Your perfect getaway starts here.</p>
            @if (auth()->check())
                @if (Auth::user()->role == 'guest')
                    <a href="{{ route('booking.index') }}" class="btn btn-primary btn-lg shadow-lg">Book Now</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg shadow-lg">Log in to Book</a>
            @endif
        </div>
    </section>

    <!-- Room Section -->
    <section id="rooms" class="rooms-section py-5">
        <div class="container text-center">
            <h1 class="section-title">Our Rooms</h1>

            <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($rooms as $room)
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <img src="{{ asset('storage/' . $room->profile_picture) }}"
                                class="d-block w-100 rounded shadow-lg" alt="Room Image" data-bs-toggle="modal"
                                data-bs-target="#gallery{{ $room->id }}">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $room->room_type }}</h5>
                                <p>₱{{ number_format($room->rate_per_night, 2) }} per night</p>
                                @if (auth()->check())
                                    @if (!in_array(Auth::user()->role, ['admin', 'super-admin']))
                                        <a href="{{ route('booking.index', ['room_id' => $room->id]) }}"
                                            class="btn btn-primary">Book Now</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">Log in to Book</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- Modal for each room -->
    @foreach ($rooms as $room)
        <div class="modal fade" id="gallery{{ $room->id }}" tabindex="-1"
            aria-labelledby="galleryLabel{{ $room->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryLabel{{ $room->id }}">{{ $room->room_type }} Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Carousel for room images -->
                        <div id="roomCarousel{{ $room->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <!-- If you have multiple images per room, loop through them here -->
                                @foreach (json_decode($room->gallery) as $image)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <img src="{{ asset('storage/' . $image) }}" class="d-block w-100"
                                            alt="{{ $room->room_type }} Image">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#roomCarousel{{ $room->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#roomCarousel{{ $room->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer d-block w-100">
                        <h4>Description:</h4>
                        <p>{{ $room->description }}</p>
                        <hr>
                        <h4>Features:</h4>
                        <ul>
                            @foreach (json_decode($room->features) as $feature)
                                <li>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach



    <!-- About Us Section -->
    <section id="about" class="about-section py-5 bg-light">
        <div class="container text-center">
            <h2 class="section-title">About Us</h2>
            <p class="section-description">Paper Country Inn offers a perfect blend of city comfort and country tranquility.
                Escape to a peaceful retreat in Bislig City.</p>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section py-5">
        <div class="container text-center">
            <h2 class="section-title">Why Choose Us?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fa fa-bed feature-icon"></i>
                        <h5 class="feature-title">Comfortable Rooms</h5>
                        <p class="feature-description">Our rooms are designed with comfort in mind, ensuring you a relaxing
                            stay.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fa fa-calendar feature-icon"></i>
                        <h5 class="feature-title">Flexible Booking</h5>
                        <p class="feature-description">With flexible booking options, we make it easy to plan your stay.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fa fa-concierge-bell feature-icon"></i>
                        <h5 class="feature-title">Exceptional Service</h5>
                        <p class="feature-description">Our friendly staff is here to make sure you have a pleasant
                            experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
