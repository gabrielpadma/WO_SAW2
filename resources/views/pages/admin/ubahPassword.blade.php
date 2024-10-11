<x-admin.layout.layout>

    <x-slot:title>
        {{ $title }}

    </x-slot>



    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ubah Password</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Ubah Password</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-4">

                            <form method="POST"
                                action="{{ route('proses-password-admin', ['user' => Auth::user()->id]) }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="old_password" class="form-label">Password Lama</label>
                                    <input type="password"
                                        class="form-control  @error('old_password') is-invalid @enderror"
                                        id="old_password" name='old_password'>
                                    @error('old_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Password Baru</label>
                                    <input type="password"
                                        class="form-control  @error('new_password') is-invalid @enderror"
                                        id="new_password" name="new_password">
                                    @error('new_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="new_password_confirmation" class="form-label">Konfirmasi
                                        Password</label>
                                    <input type="password"
                                        class="form-control  @error('new_password_confirmation') is-invalid @enderror"
                                        id="new_password_confirmation" name="new_password_confirmation">
                                    @error('new_password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>



                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    </x-admin.layout>
