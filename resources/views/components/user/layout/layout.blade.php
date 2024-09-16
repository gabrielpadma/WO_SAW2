<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ url('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ url('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">


    <!-- Vendor CSS Files -->
    <link href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ url('assets/css/main.css') }}" rel="stylesheet">
    <!--TemplateMo 591 villa agency
https://templatemo.com/tm-591-villa-agency-->
    <style>
        #btnLogout:hover {
            color: #34bf49;
            background-color: #f8f9fa;
            text-decoration: underline;
        }

        .btn-green {
            background-color: #34bf49;
            height: 38px;
            width: 138px;
            border-radius: 30px;

        }



        @media (min-width: 1200px) {
            .navmenu #btn-login {
                padding: 0 !important;
            }
        }




        @media (min-width: 1200px) {

            .navmenu a i,
            .navmenu a:focus i {
                font-size: 12px;
                line-height: 0;
                margin-left: 0px;
                transition: 0.3s;
            }
        }
    </style>
    @stack('additional-header-scripts')
    @stack('additional-header-styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="index-page">
    <x-user.header />

    {{ $slot }}

    <x-user.footer />

    <!-- Vendor JS Files -->
    <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ url('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ url('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ url('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ url('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ url('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ url('assets/js/main.js') }}"></script>


    @stack('additional-scripts')


    <x-user.modal-login />

    {{-- <livewire:auth.modal-login /> --}}

    @if (session()->has('login'))
        <script>
            Swal.fire({
                icon: '{{ session('login')['icon'] }}',
                title: '{{ session('login')['title'] }}',
                text: '{{ session('login')['message'] }}',
            });
        </script>
    @endif
    @if (session()->has('swal'))
        <script>
            Swal.fire({
                icon: '{{ session('swal')['icon'] }}',
                title: '{{ session('swal')['title'] }}',
                text: '{{ session('swal')['message'] }}',
            });
        </script>
    @endif

</body>

</html>
