<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/poppins.css') }}">
    <link href="{{ asset('css/adminpanel.css') }}" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/svg/favicon.svg') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>@yield('title') | Admin Panel</title>
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class='bx bx-paper-plane'></i>
            <span class="logo_name">Paper Country Inn</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="{{ route('homepage') }}">
                    <i class='bx bx-home'></i>
                    <span class="link_name">
                        Home
                    </span>
                </a>
                <ul class="sub-menu blank">
                    <li>
                        <a class="link_name" href="{{ route('homepage') }}">Home</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bxs-grid-alt'></i>
                    <span class="link_name">
                        Dashboard
                    </span>
                </a>
                <ul class="sub-menu blank">
                    <li>
                        <a class="link_name" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                </ul>
            </li>
            <li>
                <div class="icon-links">
                    <a href="#" class="arrow">
                        <i class='bx bx-hotel'></i>
                        <span class="link_name">
                            Rooms
                        </span>
                    </a>
                    <i class='bx bx-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a class="link_name">Room Management</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.rooms.add') }}">Add Room</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.rooms.current') }}">Current Rooms</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="icon-links">
                    <a href="#" class="arrow">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">
                            Billing
                        </span>
                    </a>
                    <i class='bx bx-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a class="link_name">Billing Management</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.billing.reservations') }}">Guest's Reservation</a>
                    </li>
                    {{-- <li>
                        <a href="#">Billing Records</a>
                    </li> --}}
                </ul>
            </li>
            <li>
                <div class="icon-links">
                    <a href="#" class="arrow">
                        <i class='bx bx-user'></i>
                        <span class="link_name">
                            Users
                        </span>
                    </a>
                    <i class='bx bx-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a class="link_name">Users Management</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.guests.index') }}">Guests</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.admins.index') }}">Admins</a>
                    </li>
                </ul>
            </li>
            {{-- <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bx-history'></i>
                    <span class="link_name">
                        History
                    </span>
                </a>
                <ul class="sub-menu blank">
                    <li>
                        <a class="link_name" href="#">History</a>
                    </li>
                </ul>
            </li> --}}
            <li>
                <a href="{{ route('admin.settings.index') }}">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">
                        Settings
                    </span>
                </a>
                <ul class="sub-menu blank">
                    <li>
                        <a class="link_name" href="{{ route('admin.settings.index') }}">Settings</a>
                    </li>
                </ul>
            </li>
            <li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/DefaultPicture.jpg') }}"
                            alt="Profile Picture" class="bx-menu">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="role">
                            {{ ucfirst(Auth::user()->role) }}
                        </div>
                    </div>
                    <!-- Add a hidden form for logout -->
                    <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                        @csrf
                    </form>
                    <!-- Logout icon with jQuery -->
                    <a href="javascript:void(0);" id="logout-btn">
                        <i class='bx bx-log-out'></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Admin Panel</span>
        </div>
        @yield('content')

    </section>

    <!-- jQuery and Bootstrap JS -->
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.arrow').click(function() {
                $(this).parent().parent().toggleClass('showMenu');
            });

            // Handle sidebar toggle
            $('.bx-menu').click(function() {
                $('.sidebar').toggleClass('close');
            });

            // Handle logout (submit the hidden form)
            $('#logout-btn').click(function() {
                $('#logout-form').submit();
            });
        });
    </script>

    @stack('scripts')

</body>

</html>
