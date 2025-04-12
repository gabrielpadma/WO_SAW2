<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Perhitungan Lowongan {{ $vacancy->judul_lowongan }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Data Perhitungan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Bobot Kriteria</h5>
                            <!-- Table with stripped rows -->
                            <table id="example" class="table datatable">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Alternatif</th>
                                        <th>Bobot Asli</th>
                                        <th>Bobot Normalisasi</th>
                                        <th>Persentase Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($normalizedWeight as $ct)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ct['nama_criteria'] }}</td>
                                            <td>{{ $ct['bobot'] }}</td>
                                            <td>{{ $ct['normalize_weight'] }}</td>
                                            <td>{{ $ct['normalize_precentage_weight'] }} %</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>Total</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $normalizedWeight->sum('normalize_weight') }}</td>
                                        <td>{{ $normalizedWeight->sum('normalize_precentage_weight') }} %</td>

                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Normalisasi Matrik</h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Alternatif</th>

                                        @foreach ($criteria as $criterion)
                                            <th>{{ $criterion->nama_criteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($formattedMatrix as $userName => $scores)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $userName }}</td>
                                            @foreach ($criteria as $criterion)
                                                <td>{{ $scores[$criterion->nama_criteria] ?? '-' }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Hasil</h5>
                            <p class="text-sm">Merupakan penjumlahan dari perkalian matriks ternormalisasi R dengan
                                vektor Bobot W</p>
                            <!-- Table with stripped rows -->
                            <form action="{{ route('simpan-saw') }}" method="post" id='formSimpanSAW'>
                                <input type="hidden" name="periode_id" value={{ $periode->id }}>
                                @csrf
                                @foreach ($hasilSAW as $hasil)
                                    <input type="hidden" name="application_id[]" value="{{ $hasil->id }}">
                                @endforeach
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Ranking</th>
                                            <th>Alternatif</th>
                                            <th>Hasil</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupedResults as $key => $hasil)
                                            @php
                                                $rowCount = $hasil->count();
                                            @endphp
                                            <tr>
                                                <td rowspan="{{ $rowCount }}">{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $hasil[0]->user->name }}
                                                </td>

                                                <td>
                                                    <input type="text"
                                                        class="form-control @error('total_score.' . $key) is-invalid @enderror"
                                                        id="total_score" name="total_score[]" placeholder=""
                                                        value="{{ old('total_score.' . $key, $hasil[0]->saw_score) }}"
                                                        readonly>
                                                    @error('total_score.' . $key)
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </td>
                                                <td>
                                                    <select
                                                        class="form-select @error('status.' . $key) is-invalid @enderror"
                                                        aria-label="Default select example" name="status[]">
                                                        @foreach ($applicantStatus as $status)
                                                            <option value="{{ $status->value }}"
                                                                {{ old('status.' . $key, $hasil[0]->status ?? '') == $status->value ? 'selected' : '' }}
                                                                {{ $status->value == $hasil[0]->status ? 'selected' : '' }}>
                                                                {{ Illuminate\Support\Str::ucfirst($status->value) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('status.' . $key)
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>

                                            @for ($i = 1; $i < $rowCount; $i++)
                                                <tr>

                                                    <td>
                                                        {{ $hasil[$i]->user->name }}
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                            class="form-control @error('total_score.' . $key) is-invalid @enderror"
                                                            id="total_score" name="total_score[]" placeholder=""
                                                            value="{{ old('total_score.' . $key, $hasil[$i]->saw_score) }}"
                                                            readonly>
                                                        @error('total_score.' . $key)
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror

                                                    </td>

                                                    <td>
                                                        <select
                                                            class="form-select @error('status.' . $key) is-invalid @enderror"
                                                            aria-label="Default select example" name="status[]">
                                                            @foreach ($applicantStatus as $status)
                                                                <option value="{{ $status->value }}"
                                                                    {{ old('status.' . $key, $hasil[$i]->status ?? '') == $status->value ? 'selected' : '' }}
                                                                    {{ $status->value == $hasil[$i]->status ? 'selected' : '' }}>
                                                                    {{ Illuminate\Support\Str::ucfirst($status->value) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('status.' . $key)
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>

                                                </tr>
                                            @endfor
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="btn-wrapper d-flex justify-content-end">
                                    <button type="submit" id='submitBtn' class="btn btn-primary">Simpan
                                        Perhitungan</button>
                                </div>
                            </form>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <script>
            $(document).ready(function() {
                DataTable.ext.errMode = 'none'
                $('.datatable').DataTable({
                    dom: 'Bfrtip', // Mengaktifkan tombol export
                    buttons: [{
                            extend: 'excelHtml5',
                            title: 'Data Perhitungan SAW',
                        },
                        {
                            extend: 'csvHtml5',
                            title: 'Data Perhitungan SAW',
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Perhitungan SAW',
                            orientation: 'portrait',
                            pageSize: 'A4',
                        },
                        {
                            extend: 'print',
                            title: 'Data Perhitungan SAW',
                        }
                    ],

                });
            });
        </script>


    </main>
</x-admin.layout.layout>
