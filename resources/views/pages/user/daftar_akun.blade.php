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

            .btn-submit {
                border-radius: 7px;
                padding: 5px 0;
                background-color: #34bf49;
                color: #ffffff;
                border: 1px solid #34bf49;
                transition: all 0.3s;
            }

            .btn-submit:hover {
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
                <h1>Daftar Akun</h1>
                <nav class="breadcrumbs">
                    <ol>
                        @foreach ($breadcrumbs as $crumbs)
                            @if ($loop->last)
                                <li class="current">{{ $crumbs['text'] }}</li>
                            @break
                        @endif
                        <li><a href="{{ $crumbs['link'] }}">{{ $crumbs['text'] }}</a></li>
                    @endforeach

                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <div class="container" data-aos="fade">

            <div class="row gy-5 gx-lg-5">

                <div class="col-lg-12">

                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" aria-describedby="UserName"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email"
                                class="form-control @error('email_daftar_akun') is-invalid @enderror" id="email"
                                name="email_daftar_akun" aria-describedby="email_address"
                                value="{{ old('email_daftar_akun') }}">
                            @error('email_daftar_akun')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password"
                                class="form-control @error('password_daftar_akun') is-invalid @enderror"
                                id="password" name="password_daftar_akun">
                            @error('password_daftar_akun')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_daftar_akun_confirmation" class="form-label">Confirm
                                Password</label>
                            <input type="password"
                                class="form-control @error('password_daftar_akun_confirmation') is-invalid @enderror"
                                id="password_daftar_akun_confirmation" name="password_daftar_akun_confirmation">
                            @error('password_daftar_akun_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-submit w-100">Submit</button>
                    </form>

                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->

</main>

</main>


</x-user.layout.index>
