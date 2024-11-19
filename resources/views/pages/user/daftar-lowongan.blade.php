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
                        <li class="current">Semua Lowongan</li>
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
                        <form>
                            <div class="mb-3">
                                <label for="user_name" class="form-label">Nama Pelamar</label>
                                <input type="text" class="form-control" id="user_name" aria-describedby="namaPelamar"
                                    value="{{ auth()->user()->name }}" readonly disabled>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Foto Full Body</label>
                                <input class="form-control" type="file" id="formFile">
                                <div class="form-text">Foto full body dengan pakaian bebas rapi. Ukuran file maksimal
                                    1MB</div>
                            </div>

                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir"
                                    aria-describedby="tempat_lahir" name="tempat_lahir">
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir"
                                    aria-describedby="tanggal_lahir" name="tanggal_lahir">
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Jenis Kelamin</label>
                                @foreach (App\JenisKelamin::cases() as $jen_kel)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="jenisKelaminRadio{{ $jen_kel->value }}" value="{{ $jen_kel->value }}">
                                        <label class="form-check-label"
                                            for="jenisKelaminRadio{{ $jen_kel->value }}">{{ $jen_kel->value }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mb-3">
                                <label for="usia" class="form-label">Usia</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="usia" aria-describedby="usia"
                                        name="usia">
                                    <span class="input-group-text" id="basic-addon2">Tahun</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option value="">-Pilih Status-</option>
                                    @foreach (App\StatusPernikahanEnum::cases() as $status_nikah)
                                        <option value="{{ $status_nikah->value }}">
                                            {{ \Illuminate\Support\Str::headline($status_nikah->value) }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input type="text" class="form-control" id="provinsi" aria-describedby="provinsi"
                                    name="provinsi">
                            </div>
                            <div class="mb-3">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" class="form-control" id="kota" aria-describedby="kota"
                                    name="kota">
                            </div>

                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No Hp</label>
                                <input type="text" class="form-control" id="no_hp" aria-describedby="no_hp"
                                    name="no_hp">
                                <small id="phone-error" style="color: red; display: none;">Nomor telepon tidak
                                    valid</small>
                            </div>



                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
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
