<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/poppins.css') }}" rel="stylesheet" />

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/svg/favicon.svg') }}">

    <title>@yield('title') | Paper Country Inn</title>

    @stack('styles')
</head>

<body class="homepage">
    <header class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/svg/logo.svg') }}" alt="Paper Country Inn" height="40" class="me-2">
                <span>Paper Country Inn</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}"
                            href="{{ route('homepage') }}">Home</a>
                    </li>

                    @if (auth()->guest())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-primary nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        @if (in_array(auth()->user()->role, ['admin', 'super-admin']))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('booking.index') }}" id="book-link">Book</a>
                            </li>
                            @unless (request()->routeIs('booking.index') || request()->routeIs('booking.confirm'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#rooms">Rooms</a>
                                </li>
                            @endunless
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ auth()->user()->profile_picture
                                    ? asset('storage/' . auth()->user()->profile_picture)
                                    : asset('images/DefaultPicture.jpg') }}"
                                    alt="Profile Picture" class="rounded-circle me-2"
                                    style="width: 30px; height: 30px; object-fit: cover;">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </header>


    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>
                        <a href="tel:+639276676984"><img src="{{ asset('images/svg/phone.svg') }}"
                                class="svg-link img-fluid"> (+63)
                            923 737 6828</a>
                    </p>
                    <p>
                        <a href="mailto:papercountryinn8@yahoo.com"><img src="{{ asset('images/svg/mail.svg') }}"
                                class="svg-link img-fluid"> papercountryinn8@yahoo.com</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.facebook.com/pcibislig" class="me-3"><img
                            src="{{ asset('images/svg/facebook.svg') }}" class="svg-link img-fluid"></a>
                    <a href="https://x.com/paperinn" class="me-3"><img src="{{ asset('images/svg/twitter.svg') }}"
                            class="svg-link img-fluid"></a>
                    <a href="https://www.instagram.com/papercountryinn/"><img
                            src="{{ asset('images/svg/instagram.svg') }}" class="svg-link img-fluid"></a>
                </div>
                <div class="col-md-4">
                    <h5>Visit Us</h5>
                    <p>Paper Country Inn


                        Tabon, Bislig City

                        Philippines 8311</p>
                    <a href="https://www.google.com/maps/place/Paper+Country+Inn/@8.1853942,126.3596173,3a,75y,111.25h,107.03t/data=!3m7!1e1!3m5!1ssX6oehwRhnU9sgMP3iubDg!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fcb_client%3Dmaps_sv.tactile%26w%3D900%26h%3D600%26pitch%3D-17.02568007918316%26panoid%3DsX6oehwRhnU9sgMP3iubDg%26yaw%3D111.24603087285266!7i16384!8i8192!4m9!3m8!1s0x32fdbbd29435ca9d:0x65a533550dcfe8fc!5m2!4m1!1i2!8m2!3d8.1854033!4d126.3596365!16s%2Fg%2F113hplmpp?entry=ttu&g_ep=EgoyMDI1MDIxMi4wIKXMDSoASAFQAw%3D%3D"
                        target="_blank">
                        <img src="{{ asset('images/svg/google-maps.svg') }}" class="svg-link img-fluid"> Google Maps
                    </a>
                </div>
            </div>
            <hr>
            <p>&copy; {{ date('Y') }} Paper Country Inn. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#navbarDropdown').on('click', function(e) {
                var $el = $(this).next('.dropdown-menu');
                var isVisible = $el.is(':visible');

                // Close all dropdowns
                $('.dropdown-menu').slideUp();
                if (!isVisible) {
                    $el.stop(true, true).slideDown();
                }
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.navbar-nav').length) {
                    $('.dropdown-menu').slideUp();
                }
            });
        });
    </script>

    @stack('scripts')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</body>

</html>
