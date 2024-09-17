<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center">
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">Active.</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.html" class="active">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="portfolio.html">Portfolio</a></li>
                <li><a href="team.html">Team</a></li>
                <li><a href="blog.html">Blog</a></li>
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

                <li><a href="contact.html">Contact</a></li>

                @guest

                    <li>
                        <button type="button"
                            class="btn d-flex gap-2 btn-login w-100 justify-content-md-center text-md-center"
                            data-bs-toggle="modal" data-bs-target="#loginModal" id="btnLogin">
                            <i class="bi bi-person-fill"></i><span>Login</span>
                        </button>
                    </li>

                @endguest


                @auth
                    <li><a href="contact.html">User</a></li>
                    {{-- <li>
                        <button type="button"
                            class="btn d-flex gap-2 btn-login w-100 justify-content-md-center text-md-center"
                            data-bs-toggle="modal" data-bs-target="#loginModal" id="btnLogin">
                            <i class="bi bi-person-fill"></i><span>Login</span>
                        </button>
                    </li> --}}

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
