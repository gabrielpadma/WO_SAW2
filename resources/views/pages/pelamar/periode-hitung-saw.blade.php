<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Periode {{ $vacancy->judul_lowongan }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('penilaian') }}">Lowongan</a></li>
                    <li class="breadcrumb-item active">Periode Lowongan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Periode</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lowongan</th>
                                        <th>Tanggal Periode</th>
                                        <th>Status</th>
                                        <th>Jumlah Pelamar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($vacancy->periode as $periode)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $vacancy->judul_lowongan }}</td>
                                            <td>{{ Carbon\Carbon::parse($periode->tanggal_periode)->format('j F Y') }}
                                            </td>
                                            <td>{!! $periode->status
                                                ? "<span class='badge bg-success'>Aktif</span>"
                                                : "<span class='badge bg-danger'>Non Aktif</span>" !!}
                                            </td>
                                            <td>{{ $periode->jumlahPelamar }}
                                            </td>
                                            <td class="d-flex gap-1">

                                                <a href="{{ route('calculate-saw', ['vacancy' => $vacancy->id, 'periode' => $periode->id]) }}"
                                                    class="btn btn-primary btn-secondary"><i
                                                        class="bi bi-info-square"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <script>
            $(document).ready(function() {
                $('.datatable').DataTable({
                    dom: 'Bfrtip', // Mengaktifkan tombol export
                    buttons: [{
                            extend: 'excelHtml5',
                            title: 'Data Lowongan',
                        },
                        {
                            extend: 'csvHtml5',
                            title: 'Data Lowongan',
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Lowongan',
                            orientation: 'portrait',
                            pageSize: 'A4',
                        },
                        {
                            extend: 'print',
                            title: 'Data Lowongan',
                        }
                    ]
                });
            });
        </script>

    </main>
</x-admin.layout.layout>
