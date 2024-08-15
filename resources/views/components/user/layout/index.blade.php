<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>{{ $title }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ url('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/templatemo-villa-agency.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!--TemplateMo 591 villa agency
https://templatemo.com/tm-591-villa-agency-->
    @stack('additional-header-scripts')


</head>

<body>

    {{-- Preloader --}}
    @include('includes.user.preloader')
    @include('includes.user.sub-header')
    @include('includes.user.header')
    @include('includes.user.main-banner')


    {{ $slot }}

    @include('includes.user.footer')

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    @stack('additional-scripts')

</body>

</html>
