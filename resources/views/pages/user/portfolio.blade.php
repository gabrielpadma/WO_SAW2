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
                <h1>Portfolio</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Portfolio</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        @foreach ($Portfolios as $portfolio)
                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                                <img src="{{ asset('storage/' . $portfolio->portfolio_thumbnail) }}" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>{{ $portfolio->portfolio_title }}</h4>
                                    <p>{{ $portfolio->client_name }}</p>
                                    <a href="{{ asset('storage/' . $portfolio->portfolio_thumbnail) }}"
                                        title="{{ $portfolio->portfolio_title }}" data-gallery="portfolio-gallery-app"
                                        class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="{{ route('portfolio-detail', ['portfolio' => $portfolio->id]) }}"
                                        title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                </div>
                            </div><!-- End Portfolio Item -->
                        @endforeach

                    </div><!-- End Portfolio Container -->

                </div>

            </div>

        </section><!-- /Portfolio Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section">

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
