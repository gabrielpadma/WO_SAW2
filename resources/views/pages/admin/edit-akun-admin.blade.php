<x-admin.layout.layout>

    <x-slot:title>
        {{ $title }}

    </x-slot>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Akun</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Akun</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header" style="color:black;">
                            Ubah Password
                        </div>
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
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header" style="color:black;">
                            Ubah Data Diri
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('proses-edit-akun-admin') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('name')]) id="name" name="name"
                                        aria-describedby="name" value="{{ old('name', $admin->name) }}" required>
                                    @error('name')
                                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('email')]) id="email" name="email"
                                        aria-describedby="email" value="{{ old('email', $admin->email) }}" required>
                                    @error('email')
                                        <div id="email" class="invalid-feedback">
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
