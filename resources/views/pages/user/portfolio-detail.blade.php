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

            iframe {
                width: 100%;
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
                <h1>Portfolio Details</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">Portofolio Details</a></li>
                        <li class="current">{{ $portfolio->portfolio_title }}</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Portfolio Details Section -->
        <section id="portfolio-details" class="portfolio-details section">

            <div class="container" data-aos="fade-up">

                <div class="portfolio-details-slider swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "navigation": {
                    "nextEl": ".swiper-button-next",
                    "prevEl": ".swiper-button-prev"
                  },
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  }
                }
              </script>
                    <div class="swiper-wrapper align-items-center" style="max-height: 400px">

                        @foreach ($portfolio->portfolio_details as $pt)
                            @php
                                $images = [];
                                for ($i = 1; $i <= 4; $i++) {
                                    $image = 'detail_image' . $i;
                                    $imagePath = $pt->$image ?? null;

                                    if ($imagePath && Storage::exists('public/' . $imagePath)) {
                                        $images[] = $imagePath;
                                    }
                                }
                            @endphp
                        @endforeach
                        @foreach ($images as $imagePath)
                            <div class="swiper-slide">
                                <img src="{{ Storage::url($imagePath) }}" alt="Portfolio Image">
                            </div>
                        @endforeach

                        @if (count($images) === 0)
                            <div class="swiper-slide">
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="No Images Available">
                            </div>
                        @endif


                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination"></div>
                </div>

                <div class="row justify-content-between gy-4 mt-4">

                    <div class="col-lg-8" data-aos="fade-up">
                        <div class="portfolio-description">
                            {!! $portfolio->portfolio_detail_desc !!}
                        </div>
                    </div>

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="portfolio-info">
                            <h3>Project information</h3>
                            <ul>
                                <li><strong>Title</strong> {{ $portfolio->portfolio_title }}</li>
                                <li><strong>Client</strong> {{ $portfolio->client_name }}</li>
                                <li><strong>Project
                                        date</strong>{{ \Carbon\Carbon::parse($portfolio->project_date)->format('d, F Y') }}
                                </li>
                                <li><strong>Project Location</strong> <a href="#">{!! $portfolio->google_maps_url !!}</a></li>

                            </ul>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Portfolio Details Section -->

    </main>


    </x-user.layout.index>
