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
        <div class="page-title light-background">
            <div class="container">
                <h1>Detail Pengumuman {{ $application->vacancy->judul_lowongan }}</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="">Detail Pengumuman</li>
                        <li class="current">{{ $application->vacancy->judul_lowongan }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- About 2 Section -->
        <section id="about-2" class="about-2 section">
            <div class="container">
                <div class="card">
                    <div class="card-header text-white fw-bold bg-primary">
                        Pengumuman
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Selamat anda dinyatakan <span
                                class="badge rounded-pill bg-success">Lulus</span> seleksi</h5>
                        <p class="card-text">Dari hasil perhitungan sistem SAW yang digunakan anda mendapatkan nilai
                            {{ $application->total_score * 100 }} .</p>
                        <p class="card-text">{!! $pengumuman->desc_pengumuman !!}</p>
                    </div>
                </div>
            </div>
        </section><!-- /About 2 Section -->


    </main>






    </x-user.layout.index>
