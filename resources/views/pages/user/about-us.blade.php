<x-user.layout.layout>

    @push('additional-header-styles')
        <style>
            .btn-login {
                border-radius: 30px;
                background-color: #34bf49;
                color: #ffffff;
                border: 1px solid #34bf49;
                transition: all 0.3s;
            }

            .btn-login:hover {
                background-color: #ffffff;
                color: #34bf49;
                border: 1px solid #34bf49;
            }
        </style>
    @endpush




    <x-slot:title>
        {{ $title }}
    </x-slot>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <h1>About</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">About</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- About 2 Section -->
        <section id="about-2" class="about-2 section">

            <div class="container">
                <div class="content">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 order-lg-2 offset-xl-1 mb-4">
                            <div class="img-wrap text-center text-md-left" data-aos="fade-up" data-aos-delay="100">
                                <div class="img">
                                    <img src="{{ Storage::url($AboutUs->mission_image) }}" alt="circle image"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <div class="offset-md-0 offset-lg-1 col-sm-12 col-md-5 col-lg-5 col-xl-4" data-aos="fade-up">
                            <div class="px-3">
                                <span class="content-subtitle">Misi Kami</span>
                                <h2 class="content-title text-start">
                                    {{ $AboutUs->mission_title }}
                                </h2>
                                {!! $AboutUs->mission_desc !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /About 2 Section -->



        <!-- Stats Section -->
        <section id="stats" class="stats section light-background">

            <div class="container">

                <div class="row gy-4 justify-content-center">

                    <div class="col-lg-5">
                        <div class="images-overlap">
                            <img src="{{ Storage::url($AboutUs->why_us_image) }}" alt="student" class="img-fluid img-1"
                                data-aos="fade-up">
                        </div>
                    </div>

                    <div class="col-lg-4 ps-lg-5">
                        <span class="content-subtitle">Kenapa Memilih Kami</span>
                        <h2 class="content-title">{{ $AboutUs?->why_us_title }}</h2>
                        {!! $AboutUs?->why_us_desc !!}
                        <div class="row mb-5 count-numbers">

                            <!-- Start Stats Item -->
                            <div class="col-4 counter" data-aos="fade-up" data-aos-delay="100">
                                <span data-purecounter-separator="true" data-purecounter-start="0"
                                    data-purecounter-end="{{ $AboutUs?->total_project }}" data-purecounter-duration="1"
                                    class="purecounter number"></span>
                                <span class="d-block">Total Project</span>
                            </div>
                            <!-- End Stats Item -->

                            <!-- Start Stats Item -->
                            <div class="col-4 counter" data-aos="fade-up" data-aos-delay="200">
                                <span data-purecounter-separator="true" data-purecounter-start="0"
                                    data-purecounter-end="{{ $AboutUs?->total_vendor }}" data-purecounter-duration="1"
                                    class="purecounter number"></span>
                                <span class="d-block">Total Vendor</span>
                            </div>
                            <!-- End Stats Item -->

                            <!-- Start Stats Item -->
                            <div class="col-4 counter" data-aos="fade-up" data-aos-delay="300">
                                <span data-purecounter-separator="true" data-purecounter-start="0"
                                    data-purecounter-end="{{ $AboutUs?->team_members }}" data-purecounter-duration="1"
                                    class="purecounter number"></span>
                                <span class="d-block">Anggota Tim</span>
                            </div>
                            <!-- End Stats Item -->

                        </div>
                    </div>

                </div>

            </div>
        </section><!-- /Stats Section -->
        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <p>Happy Customers</p>
                <h2>Testimonials</h2>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="swiper init-swiper">
                            <script type="application/json" class="swiper-config">
                    {
                      "loop": true,
                      "speed": 600,
                      "autoplay": {
                        "delay": 5000
                      },
                      "slidesPerView": "auto",
                      "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                      },
                      "breakpoints": {
                        "320": {
                          "slidesPerView": 1,
                          "spaceBetween": 40
                        },
                        "1200": {
                          "slidesPerView": 1,
                          "spaceBetween": 1
                        }
                      }
                    }
                  </script>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testimonial mx-auto">
                                        <figure class="img-wrap">
                                            <img src="assets/img/testimonials/testimonials-1.jpg" alt="Image"
                                                class="img-fluid">
                                        </figure>
                                        <h3 class="name">Adam Aderson</h3>
                                        <blockquote>
                                            <p>
                                                “There live the blind texts. Separated they live in
                                                Bookmarksgrove right at the coast of the Semantics, a large
                                                language ocean.”
                                            </p>
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial mx-auto">
                                        <figure class="img-wrap">
                                            <img src="assets/img/testimonials/testimonials-2.jpg" alt="Image"
                                                class="img-fluid">
                                        </figure>
                                        <h3 class="name">Lukas Devlin</h3>
                                        <blockquote>
                                            <p>
                                                “There live the blind texts. Separated they live in
                                                Bookmarksgrove right at the coast of the Semantics, a large
                                                language ocean.”
                                            </p>
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial mx-auto">
                                        <figure class="img-wrap">
                                            <img src="assets/img/testimonials/testimonials-3.jpg" alt="Image"
                                                class="img-fluid">
                                        </figure>
                                        <h3 class="name">Kayla Bryant</h3>
                                        <blockquote>
                                            <p>
                                                “There live the blind texts. Separated they live in
                                                Bookmarksgrove right at the coast of the Semantics, a large
                                                language ocean.”
                                            </p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Testimonials Section -->

    </main>


    </x-user.layout.index>
