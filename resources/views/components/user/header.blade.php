{{-- @push('additional-header-styles')
    <style>
        #btnLogout:hover {
            color: #34bf49;
            background-color: #f8f9fa;
            text-decoration: underline;
        }
    </style>
@endpush --}}
<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center gap-5 ">

        <a href="index.html" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">Active.</h1>
        </a>

        <nav id="navmenu" class="navmenu w-100">
            <ul>
                <li><a href="index.html" class="active">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="portfolio.html">Portfolio</a></li>

                <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="#">Deep Dropdown 1</a></li>
                                <li><a href="#">Deep Dropdown 2</a></li>
                                <li><a href="#">Deep Dropdown 3</a></li>
                                <li><a href="#">Deep Dropdown 4</a></li>
                                <li><a href="#">Deep Dropdown 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Dropdown 2</a></li>
                        <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li>
                    </ul>
                </li>

                @guest

                    <li class="ms-auto">
                        <button type="button"
                            class="btn d-flex gap-2 btn-login w-100 ms-auto justify-content-md-center text-md-center"
                            data-bs-toggle="modal" data-bs-target="#loginModal" id="btnLogin">
                            <i class="bi bi-person-fill"></i><span>Login</span>
                        </button>
                    </li>

                @endguest


                @auth

                    <li class="dropdown btn-green ms-auto d-flex justify-content-center align-items-center">
                        <a href="#" class="text-white d-lg-flex justify-content-between gap-1 align-items-center"
                            id="btn-login">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                            <span>Hey, {{ Auth::user()->name }}</span>
                            <i class="bi bi-chevron-down text-white"></i></a>
                        <ul>
                            <li><a href="#">Ubah Password</a></li>
                            <li>
                                <form method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item" id="btnLogout"
                                        style="background: none; border: none; padding: 10px 20px;">
                                        Logout
                                    </button>
                                </form>
                            </li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li>
                @endauth

                <!-- Tampilkan pada sm ke bawah, sembunyikan pada md ke atas -->
                {{-- <li class="d-block d-lg-none">
                    <a href="contact.html">Login</a>
                </li> --}}


            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>





</header>
