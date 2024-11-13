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

            .cover-image {
                width: 100%;
                object-fit: cover;
                background-size: cover;
                background-position: center;
            }
        </style>
    @endpush




    <x-slot:title>
        {{ $title }}
    </x-slot>

    <main class="main">


        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2" data-aos="fade-up" data-aos-delay="400">
                        <div class="swiper init-swiper" style="max-height: 500px;">
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
                                @for ($i = 1; $i <= 5; $i++)
                                    @php
                                        $imagePath = "image_path{$i}";
                                    @endphp

                                    @if (!empty($heroData->{$imagePath}))
                                        <div class="swiper-slide">
                                            <img src="{{ asset('storage/' . $heroData->{$imagePath}) }}"
                                                alt="Hero Image {{ $i }}" class="img-fluid cover-image">
                                        </div>
                                    @else
                                        @continue
                                    @endif
                                @endfor
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-lg-1">
                        <span class="section-subtitle" data-aos="fade-up">Selamat Datang</span>
                        <h1 class="mb-4" data-aos="fade-up">
                            {{ $heroData->welcome_text ?? 'Data Hero Kosong' }}
                        </h1>
                        <p data-aos="fade-up">
                            {!! $heroData->content_text ?? 'Data Hero Kosong' !!}
                        </p>
                        <p class="mt-5" data-aos="fade-up">
                            <a href="#" class="btn btn-get-started">Mulai</a>
                        </p>
                    </div>
                </div>
            </div>
        </section><!-- /About Section -->

        <!-- About 2 Section -->
        <section id="about-2" class="about-2 section light-background">

            <div class="container">
                <div class="content">
                    <div class="row justify-content-center">
                        <div
                            class="col-sm-12 col-md-5 col-lg-4 col-xl-4 order-lg-2 offset-xl-1 mb-4 d-flex align-items-center">
                            <div class="img-wrap text-center text-md-left" data-aos="fade-up" data-aos-delay="100">
                                <div class="img">
                                    <img src="{{ Storage::url($AboutUs->mission_image) }}" alt="circle image"
                                        style="background-size:cover;background-position:center;" class="img-fluid">
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
                                <p>
                                    <a href="{{ route('about-us') }}" class="btn-get-started">Get Started</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /About 2 Section -->

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <div class="container">
                <div class="row gy-4 justify-content-center">

                    <div class="col-lg-3">
                        <div class="services-item" data-aos="fade-up">
                            <div class="services-icon">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div>
                                <h3>Konsultasi</h3>
                                <p>Konsultasi mengenai event pernikahan</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="services-item" data-aos="fade-up" data-aos-delay="100">
                            <div class="services-icon">
                                <i class="bi bi-gift"></i>
                            </div>
                            <div>
                                <h3>Paket Pernikahan</h3>
                                <p>Paket pernikahan lengkap dari vendor kami</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="services-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="services-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div>
                                <h3>Booking</h3>
                                <p>Proses booking muda dan cepat </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- /Services Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section light-background">

            <div class="container">

                <div class="row gy-4 justify-content-center">

                    <div class="col-lg-5">
                        <div class="images-overlap d-flex justify-content-center">
                            <img src="{{ Storage::url($AboutUs->why_us_image) }}" alt="student" class="img-fluid img-1"
                                style="background-size: cover" data-aos="fade-up">
                        </div>
                    </div>

                    <div class="col-lg-4 ps-lg-5">
                        <span class="content-subtitle">Kenapa Memilih Kami</span>
                        <h2 class="content-title">{{ $AboutUs->why_us_title }}</h2>
                        {!! $AboutUs->why_us_desc !!}
                        <div class="row mb-5 count-numbers">

                            <!-- Start Stats Item -->
                            <div class="col-4 counter" data-aos="fade-up" data-aos-delay="100">
                                <span data-purecounter-separator="true" data-purecounter-start="0"
                                    data-purecounter-end="{{ $AboutUs->total_project }}" data-purecounter-duration="1"
                                    class="purecounter number"></span>
                                <span class="d-block">Total Project</span>
                            </div>
                            <!-- End Stats Item -->

                            <!-- Start Stats Item -->
                            <div class="col-4 counter" data-aos="fade-up" data-aos-delay="200">
                                <span data-purecounter-separator="true" data-purecounter-start="0"
                                    data-purecounter-end="{{ $AboutUs->total_vendor }}" data-purecounter-duration="1"
                                    class="purecounter number"></span>
                                <span class="d-block">Total Vendor</span>
                            </div>
                            <!-- End Stats Item -->

                            <!-- Start Stats Item -->
                            <div class="col-4 counter" data-aos="fade-up" data-aos-delay="300">
                                <span data-purecounter-separator="true" data-purecounter-start="0"
                                    data-purecounter-end="{{ $AboutUs->team_members }}" data-purecounter-duration="1"
                                    class="purecounter number"></span>
                                <span class="d-block">Anggota Team</span>
                            </div>
                            <!-- End Stats Item -->

                        </div>
                    </div>

                </div>

            </div>
        </section><!-- /Stats Section -->

        <!-- Services 2 Section -->
        <section id="services-2" class="services-2 section">
            <div class="container">
                <div class="row justify-content-center align-items-center" data-aos="fade-up">
                    <div class="col-md-6 col-lg-4">
                        <span class="content-subtitle">Layanan Kami</span>
                        <h2 class="content-title">
                            {{ $Service->service_title }}
                        </h2>
                        {!! $Service->service_desc !!}
                        <p>
                            <a href="#" class="btn btn-get-started"> <i class="bi bi-whatsapp me-2"></i>Hubungi
                                Kami
                                Sekarang</a>
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-6 ps-lg-5">
                        <div class="row">
                            @for ($i = 1; $i <= 6; $i++)
                                @php
                                    $objIconService = 'icon_service_' . $i;
                                    $objServiceText = 'service_text_' . $i;
                                    $objIconTitle = 'icon_title_' . $i;
                                @endphp

                                @if (is_null($Service->$objIconService) && is_null($Service->$objServiceText) && is_null($Service->$objIconTitle))
                                    @continue
                                @endif
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="services-item" data-aos="fade-up" data-aos-delay="">
                                        <div class="services-icon">
                                            <i class="{{ $Service->$objIconService }}"></i>
                                        </div>
                                        <div>
                                            <h3>{{ $Service->$objIconTitle }}</h3>
                                            <p>
                                                {{ $Service->$objServiceText }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endfor

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        <section id="pricing" class="pricing section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <p>Paket Wedding</p>
                <h2>Pilihan Paket</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    @foreach ($WeddingPackages as $package)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="pricing-item">
                                @if ($package->is_recommend)
                                    <span class="recommended-badge">Recommended</span>
                                @endif

                                <h3>{{ $package->package_title }}</h3>
                                <h4><sup>Rp</sup>{{ $package->price }}</h4>
                                <ul>
                                    @foreach ($package->features as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                                <div class="btn-wrap">
                                    <a href="#" class="btn-buy"> <i class="bi bi-whatsapp me-2"></i>Hubungi
                                        Kami
                                        Sekarang</a>
                                </div>
                            </div>
                        </div><!-- End Pricing Item -->
                    @endforeach

                </div>

            </div>

        </section><!-- /Pricing Section -->

        <section id="testimonials" class="testimonials section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <p>Happy Couples</p>
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
                                @foreach ($Testimonials as $item)
                                    <div class="swiper-slide">
                                        <div class="testimonial mx-auto">
                                            <figure class="img-wrap">
                                                <img src="{{ Storage::url($item->testimonial_image) }}"
                                                    alt="Image" class="img-fluid">
                                            </figure>
                                            <h3 class="name">{{ $item->testimonial_customer_name }}</h3>
                                            <blockquote>
                                                {!! $item->testimonial_desc !!}
                                            </blockquote>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Testimonials Section -->

    </main>


    </x-user.layout.index>
