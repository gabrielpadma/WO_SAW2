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
                <h1>Data Diri</h1>
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

                <div class="col-lg-4">

                    <div class="info">
                        <form method="POST" action="{{ route('user.update', ['user' => Auth::user()->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Password Lama</label>
                                <input type="password"
                                    class="form-control @error('old_password') is-invalid @enderror"
                                    id="old_password" name="old_password">
                                @error('old_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
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


                    </div>

                </div>

                <div class="col-lg-8">

                    <form method="POST" action="{{ route('simpan-data-diri') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value={{ old('name', $User->name) }}
                                aria-describedby="UserName">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value={{ old('email', $User->email) }}
                                aria-describedby="UserName">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat" name="alamat" value={{ old('alamat', $User->alamat) }}
                                aria-describedby="UserName">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto Full Body</label>
                            <input @class(['form-control ', 'is-invalid' => $errors->has('foto')]) type="file" id="formFile" name="foto"
                                {{ $User?->foto ? '' : 'required' }}>
                            @php
                                if ($User?->foto) {
                                    $fileName = $User->foto ? basename($User->foto) : 'Tidak ada file';
                                }
                            @endphp

                            @if ($User?->foto ?? false)
                                <p>File yang sudah diunggah: <a href="{{ asset('storage/' . $User->foto) }}"
                                        target="_blank">{{ $fileName }}</a></p>
                            @else
                                <div class="form-text">Lampiran dengan ijazah dengan file pdf. Ukuran file maksimal
                                    1MB</div>
                            @endif
                            @error('foto')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="tempat_lahir" name="tempat_lahir"
                                value={{ old('tempat_lahir', $User->tempat_lahir) }}
                                aria-describedby="tempat_lahir">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" name="tanggal_lahir"
                                value={{ old('tanggal_lahir', $User->tanggal_lahir) }}
                                aria-describedby="tanggal_lahir">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <select @class(['form-select ', 'is-invalid' => $errors->has('agama')]) id="agama" name="agama" required>
                                <option value="">--Pilih--</option>
                                @foreach (App\AgamaEnum::cases() as $agama)
                                    <option value="{{ $agama->value }}"
                                        {{ old('agama', $User->agama) == $agama->value ? 'selected' : '' }}>
                                        {{ \Illuminate\Support\Str::headline($agama->value) }}</option>
                                @endforeach
                            </select>

                            @error('agama')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            @foreach (App\JenisKelamin::cases() as $jen_kel)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="jenisKelaminRadio{{ $jen_kel->value }}"
                                        value="{{ $jen_kel->value }}"
                                        {{ old('jenis_kelamin', $User->jenis_kelamin) == $jen_kel->value ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="jenisKelaminRadio{{ $jen_kel->value }}">
                                        {{ $jen_kel->value }}
                                    </label>
                                </div>
                            @endforeach
                            @error('jenis_kelamin')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                            <select @class([
                                'form-select',
                                'is-invalid' => $errors->has('status_pernikahan'),
                            ]) aria-label="Default select example"
                                name="status_pernikahan" required>
                                <option value="">-Pilih Status-</option>
                                @foreach (App\StatusPernikahanEnum::cases() as $status_nikah)
                                    <option value="{{ $status_nikah->value }}"
                                        {{ old('status_pernikahan', $User->status_pernikahan) == $status_nikah->value ? 'selected' : '' }}>
                                        {{ \Illuminate\Support\Str::headline($status_nikah->value) }}</option>
                                @endforeach
                            </select>
                            @error('status_pernikahan')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('provinsi')]) id="provinsi"
                                aria-describedby="provinsi" name="provinsi"
                                value="{{ old('provinsi', $User->provinsi) }}" required>
                            @error('provinsi')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('provinsi')]) id="kota"
                                aria-describedby="kota" name="kota" value="{{ old('kota', $User->kota) }}"
                                required>
                            @error('kota')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No Hp</label>
                            <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('no_hp')]) id="no_hp"
                                aria-describedby="no_hp" name="no_hp" value="{{ old('no_hp', $User->no_hp) }}"
                                required>
                            <small id="phone-error" style="color: red; display: none;">Nomor telepon tidak
                                valid</small>
                            @error('no_hp')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="asal_sekolah" @class(['form-label ', 'is-invalid' => $errors->has('asal_sekolah')])>Asal Sekolah / Universitas
                            </label>
                            <input type="text" class="form-control" id="asal_sekolah"
                                aria-describedby="asal_sekolah" name="asal_sekolah"
                                value="{{ old('asal_sekolah', $User->asal_sekolah) }}" required>
                            @error('asal_sekolah')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="jurusan" @class(['form-label ', 'is-invalid' => $errors->has('jurusan')])>Jurusan
                            </label>
                            <input type="text" class="form-control" id="jurusan" aria-describedby="jurusan"
                                name="jurusan" value="{{ old('jurusan', $User->jurusan) }}" required>
                            @error('jurusan')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="lampiran_ijazah" class="form-label">Lampiran Ijazah</label>
                            <input @class([
                                'form-control ',
                                'is-invalid' => $errors->has('lampiran_ijazah'),
                            ]) type="file" id="lampiran_ijazah"
                                {{ $User?->lampiran_ijazah ? '' : 'required' }} name="lampiran_ijazah">


                            @php
                                if ($User?->lampiran_ijazah) {
                                    $fileName = $User->lampiran_ijazah
                                        ? basename($User->lampiran_ijazah)
                                        : 'Tidak ada file';
                                }
                            @endphp

                            @if ($User?->lampiran_ijazah ?? false)
                                <p>File yang sudah diunggah: <a
                                        href="{{ asset('storage/' . $User->lampiran_ijazah) }}"
                                        target="_blank">{{ $fileName }}</a></p>
                            @else
                                <div class="form-text">Lampiran dengan ijazah dengan file pdf. Ukuran file maksimal
                                    1MB</div>
                            @endif


                            @error('lampiran_ijazah')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>



                        <div class="mb-3">
                            <label for="lampiran_cv" class="form-label">Lampiran CV</label>
                            <input @class(['form-control ', 'is-invalid' => $errors->has('lampiran_cv')]) type="file" id="lampiran_cv"
                                name="lampiran_cv" {{ $User?->lampiran_cv ? '' : 'required' }}>
                            @php
                                if ($User?->lampiran_cv) {
                                    $fileName = $User->lampiran_cv ? basename($User->lampiran_cv) : 'Tidak ada file';
                                }
                            @endphp

                            @if ($User?->lampiran_cv ?? false)
                                <p>File yang sudah diunggah: <a
                                        href="{{ asset('storage/' . $User->lampiran_cv) }}"
                                        target="_blank">{{ $fileName }}</a></p>
                            @else
                                <div class="form-text">Lampiran dengan ijazah dengan file pdf. Ukuran file maksimal
                                    1MB</div>
                            @endif

                            @error('lampiran_cv')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="lampiran_keterangan_sehat" class="form-label">Lampiran Keterangan
                                Sehat</label>
                            <input @class([
                                'form-control ',
                                'is-invalid' => $errors->has('lampiran_keterangan_sehat'),
                            ]) type="file" id="lampiran_keterangan_sehat"
                                name="lampiran_keterangan_sehat"
                                {{ $User?->lampiran_keterangan_sehat ? '' : 'required' }}>
                            @php
                                if ($User?->lampiran_keterangan_sehat) {
                                    $fileName = $User->lampiran_keterangan_sehat
                                        ? basename($User->lampiran_keterangan_sehat)
                                        : 'Tidak ada file';
                                }
                            @endphp

                            @if ($User?->lampiran_keterangan_sehat ?? false)
                                <p>File yang sudah diunggah: <a
                                        href="{{ asset('storage/' . $User->lampiran_keterangan_sehat) }}"
                                        target="_blank">{{ $fileName }}</a></p>
                            @else
                                <div class="form-text">Lampiran dengan ijazah dengan file pdf. Ukuran file maksimal
                                    1MB</div>
                            @endif
                            @error('lampiran_keterangan_sehat')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="lampiran_skck" class="form-label">Lampiran SKCK</label>
                            <input @class([
                                'form-control ',
                                'is-invalid' => $errors->has('lampiran_skck'),
                            ]) type="file" id="lampiran_skck"
                                name="lampiran_skck" {{ $User?->lampiran_skck ? '' : 'required' }}>
                            @php
                                if ($User?->lampiran_skck) {
                                    $fileName = $User->lampiran_skck
                                        ? basename($User->lampiran_skck)
                                        : 'Tidak ada file';
                                }
                            @endphp

                            @if ($User?->lampiran_skck ?? false)
                                <p>File yang sudah diunggah: <a
                                        href="{{ asset('storage/' . $User->lampiran_skck) }}"
                                        target="_blank">{{ $fileName }}</a></p>
                            @else
                                <div class="form-text">Lampiran dengan ijazah dengan file pdf. Ukuran file maksimal
                                    1MB</div>
                            @endif
                            @error('lampiran_skck')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>



                        <div class="mb-3">
                            <label for="lampiran_ktp" class="form-label">Lampiran KTP</label>
                            <input @class([
                                'form-control ',
                                'is-invalid' => $errors->has('lampiran_ktp'),
                            ]) type="file" id="lampiran_ktp"
                                name="lampiran_ktp" {{ $User?->lampiran_ktp ? '' : 'required' }}>
                            @php
                                if ($User?->lampiran_ktp) {
                                    $fileName = $User->lampiran_ktp ? basename($User->lampiran_ktp) : 'Tidak ada file';
                                }
                            @endphp

                            @if ($User?->lampiran_ktp ?? false)
                                <p>File yang sudah diunggah: <a
                                        href="{{ asset('storage/' . $User->lampiran_ktp) }}"
                                        target="_blank">{{ $fileName }}</a></p>
                            @else
                                <div class="form-text">Lampiran dengan ijazah dengan file pdf. Ukuran file maksimal
                                    1MB</div>
                            @endif
                            @error('lampiran_ktp')
                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
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
