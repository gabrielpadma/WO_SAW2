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

        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">Alucio.</h1>
        </a>

        <nav id="navmenu" class="navmenu w-100">
            <ul>
                <li><a href="{{ url('/') }}" class="active">Home</a></li>
                <li><a href="{{ route('about-us') }}">Tentang Kami</a></li>
                <li><a href="{{ route('our-services') }}">Layanan</a></li>
                <li><a href="{{ route('portfolio-user') }}">Portfolio</a></li>

                <li class="dropdown"><a href="#"><span>Lowongan</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="{{ route('lowongan') }}">Daftar Lowongan</a></li>




                        @auth
                            <li><a href="{{ route('pengumuman') }}">Pengunguman
                                    Lowongan</a></li>
                        @endauth
                        @guest

                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Pengunguman
                                    Lowongan</a></li>
                        @endguest




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
                            <li>
                                <a href="{{ route('user.edit', ['user' => Auth::user()->id]) }}">Ubah
                                    Password</a>
                            </li>
                            <li>
                                <a href="{{ route('data-diri') }}">Data Diri</a>
                            </li>
                            <li>
                                <form method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item" id="btnLogout"
                                        style="background: none; border: none; padding: 10px 20px;">
                                        Logout
                                    </button>
                                </form>
                            </li>

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
