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
                <h1>Lowongan</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Lowongan</a></li>
                        <li class="current">{{ $vacancy->judul_lowongan }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- About 2 Section -->
        <section id="about-2" class="about-2 section">

            <div class="container">
                <div class="card">
                    <div class="card-header text-start bg-dark text-white">
                        Form Daftar Lamaran : {{ $vacancy->judul_lowongan }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('simpan-lamaran', ['vacancy' => $vacancy->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="user_name" class="form-label">Nama Pelamar</label>
                                <input type="text" class="form-control" id="user_name" aria-describedby="namaPelamar"
                                    value="{{ auth()->user()->name }}" readonly disabled>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Foto Full Body</label>
                                <input @class(['form-control ', 'is-invalid' => $errors->has('foto')]) type="file" id="formFile" name="foto"
                                    required>
                                <div class="form-text">Foto full body dengan pakaian bebas rapi. Ukuran file maksimal
                                    1MB</div>
                                @error('foto')
                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" @class([
                                    'form-control ',
                                    'is-invalid' => $errors->has('tempat_lahir'),
                                ]) id="tempat_lahir"
                                    aria-describedby="tempat_lahir" name="tempat_lahir"
                                    value="{{ old('tempat_lahir') }}" required>
                                @error('tempat_lahir')
                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" @class([
                                    'form-control ',
                                    'is-invalid' => $errors->has('tanggal_lahir'),
                                ]) id="tanggal_lahir"
                                    aria-describedby="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir') }}" required>
                                @error('tanggal_lahir')
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
                                            id="jenisKelaminRadio{{ $jen_kel->value }}" value="{{ $jen_kel->value }}"
                                            {{ old('jenis_kelamin') == $jen_kel->value ? 'checked' : '' }} required>
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
                                <label for="usia" class="form-label">Usia</label>
                                <div class="input-group">
                                    <input type="number" @class(['form-control ', 'is-invalid' => $errors->has('usia')]) id="usia"
                                        aria-describedby="usia" name="usia" value="{{ old('usia') }}" required>
                                    <span class="input-group-text" id="basic-addon2">Tahun</span>
                                    @error('usia')
                                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                                <select class="form-select" aria-label="Default select example" name="status_pernikahan"
                                    required>
                                    <option value="">-Pilih Status-</option>
                                    @foreach (App\StatusPernikahanEnum::cases() as $status_nikah)
                                        <option value="{{ $status_nikah->value }}"
                                            {{ old('status_pernikahan') == $status_nikah->value ? 'selected' : '' }}>
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
                                    aria-describedby="provinsi" name="provinsi" value="{{ old('provinsi') }}" required>
                                @error('provinsi')
                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('provinsi')]) id="kota"
                                    aria-describedby="kota" name="kota" value="{{ old('kota') }}" required>
                                @error('kota')
                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No Hp</label>
                                <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('no_hp')]) id="no_hp"
                                    aria-describedby="no_hp" name="no_hp" value="" required>
                                <small id="phone-error" style="color: red; display: none;">Nomor telepon tidak
                                    valid</small>
                                @error('no_hp')
                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="asal_sekolah" @class([
                                    'form-control ',
                                    'is-invalid' => $errors->has('asal_sekolah'),
                                ])>Asal Sekolah / Universitas
                                </label>
                                <input type="text" class="form-control" id="asal_sekolah"
                                    aria-describedby="asal_sekolah" name="asal_sekolah"
                                    value="{{ old('asal_sekolah') }}" required>
                                @error('asal_sekolah')
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
                                ]) type="file" id="lampiran_ijazah" required
                                    name="lampiran_ijazah">
                                <div class="form-text">Lampiran dengan ijazah dengan file pdf. Ukuran file maksimal
                                    1MB</div>
                                @error('lampiran_ijazah')
                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lampiran_cv" class="form-label">Lampiran CV</label>
                                <input @class(['form-control ', 'is-invalid' => $errors->has('lampiran_cv')]) type="file" id="lampiran_cv"
                                    name="lampiran_cv" required>
                                <div class="form-text">Lampiran dengan CV dengan file pdf. Ukuran file maksimal
                                    1MB</div>
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
                                    name="lampiran_keterangan_sehat" required>
                                <div class="form-text">Lampiran dengan surat keterangan sehat dengan file pdf. Ukuran
                                    file maksimal
                                    1MB</div>
                                @error('lampiran_keterangan_sehat')
                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="lampiran_keterangan_skck" class="form-label">Lampiran SKCK</label>
                                <input @class([
                                    'form-control ',
                                    'is-invalid' => $errors->has('lampiran_keterangan_skck'),
                                ]) type="file" id="lampiran_keterangan_skck"
                                    name="lampiran_keterangan_skck" required>
                                <div class="form-text">Lampiran dengan SKCK dengan file pdf. Ukuran file maksimal
                                    1MB</div>
                                @error('lampiran_keterangan_skck')
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
                                    name="lampiran_ktp" required>
                                <div class="form-text">Lampiran dengan KTP dengan file pdf. Ukuran file maksimal
                                    1MB</div>
                                @error('lampiran_ktp')
                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </section><!-- /About 2 Section -->


    </main>

    @push('additional-scripts')
        <script>
            $(document).ready(function() {
                $('#tabelLowongan').DataTable();


                $('#no_hp').on('keyup', function() {
                    const phone = $(this).val();
                    const phoneRegex = /^(?:\+62|62|08)[2-9][0-9]{7,11}$/;

                    if (!phoneRegex.test(phone)) {
                        $('#phone-error').text('Nomor telepon tidak valid').show();
                    } else {
                        $('#phone-error').hide();
                    }
                });


                $('#no_hp').on('keypress', function(event) {
                    const charCode = event.which || event.keyCode;
                    const charStr = String.fromCharCode(charCode);
                    const allowedChars = /^[0-9+]+$/;

                    if (!allowedChars.test(charStr) && charCode > 31) {
                        event.preventDefault();
                    }
                });

                $('#no_hp').on('keyup', function() {
                    const phone = $(this).val();

                    // Regex untuk nomor telepon Indonesia
                    const phoneRegex = /^(?:\+62|62|08)[2-9][0-9]{7,11}$/;

                    if (!phoneRegex.test(phone)) {
                        $('#phone-error').text('Nomor telepon tidak valid').show();
                    } else {
                        $('#phone-error').hide();
                    }
                });


            });
        </script>
    @endpush


    </x-user.layout.index>
