<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link href="{{ asset('/css/loginregister.css') }}" rel="stylesheet">
    <link href="{{ asset('css/poppins.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/svg/favicon.svg') }}">

    <title>@yield('title') | Paper Country Inn</title>
</head>

<body class="homepage">

    @yield('content')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
