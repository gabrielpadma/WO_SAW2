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
                <h1>Services</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Services</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Page Title -->

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
        <!-- /Services 2 Section -->


    </main>


    </x-user.layout.index>
