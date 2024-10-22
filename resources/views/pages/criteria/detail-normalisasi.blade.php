<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Criteria Lowongan {{ $vacancy->judul_lowongan }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"> <a href="{{ route('criteria.index') }}"> Criteria</a></li>
                    <li class="breadcrumb-item active">Normalisasi Kriteria</li>
                    <li class="breadcrumb-item active">{{ $vacancy->id }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Criteria Normalisasi</h5>
                            <p>Bobot criteria yang sudah dinormalisasi dengan rumus Bobot Ternormalisasi bobot ke i =
                                bobot ke i / total bobot </p>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Simbol</th>
                                        <th>Kriteria</th>
                                        <th>Lowongan Pekerjaan</th>
                                        <th>Bobot</th>
                                        <th>Persentase</th>
                                        <th>Atribut</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($normalizeCriterias as $criteria)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>C{{ $loop->iteration }}</td>
                                            <td>{{ $criteria['nama_criteria'] }}</td>
                                            <td>{{ $criteria['vacancy']['judul_lowongan'] }}</td>
                                            <td>{{ $criteria['normalize_weight'] }}</td>
                                            <td>{{ $criteria['normalize_precentage_weight'] }} %</td>
                                            <td>{{ $criteria['jenis_criteria'] }}</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $totalBobotNormalize }}</td>
                                        <td>{{ $totalBobotPersen }} %</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>


    </main>
</x-admin.layout.layout>
