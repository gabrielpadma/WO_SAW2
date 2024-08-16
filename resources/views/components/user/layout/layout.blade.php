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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!--TemplateMo 591 villa agency
https://templatemo.com/tm-591-villa-agency-->
    @stack('additional-header-scripts')
    @stack('additional-header-styles')
</head>

<body class="index-page">
    @include('includes.user.header')


    {{ $slot }}




    @include('includes.user.footer')

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    @stack('additional-scripts')

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex">
                    <img src="{{ url('assets/img/login-img.jpg') }}" class="img-fluid d-none d-md-block"
                        style="object-position:center center;border-radius: 5px 0 0 5px;
                        width:40%;
                        "
                        alt="...">
                    <div class="isi-modal w-100">
                        <div class="modal-body d-flex flex-column gap-3">
                            <h4 class="text-dark">Selamat datang</h4>
                            <form>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label small">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label small">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1">
                                </div>

                                <button type="button" class="btn btn-primary w-100">Login</button>
                                <div id="emailHelp" class="form-text mt-3 small text-secondary">Belum punya akun ? <a
                                        href="#">Daftar
                                        Akun</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>
