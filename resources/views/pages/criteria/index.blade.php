<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Semua Criteria</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Criteria</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Lowongan </h5>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lowongan</th>
                                        <th>Periode</th>
                                        <th>Jumlah Kriteria</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allVacancies as $vacancy)
                                        @if ($vacancy->periode->isNotEmpty())
                                            @foreach ($vacancy->periode as $key => $periode)
                                                <tr>
                                                    <td>{{ $loop->parent->iteration }}
                                                    </td>
                                                    <td>{{ $vacancy->judul_lowongan }}
                                                    </td>

                                                    <td>{{ \Carbon\Carbon::parse($periode->tanggal_periode)->format('F Y') }}
                                                    </td>
                                                    <td>{{ $periode->criterias->count() }}</td>
                                                    <td class="d-flex gap-1">
                                                        <a href="{{ route('detail-periode', ['vacancy' => $vacancy->id, 'periode' => $periode->id]) }}"
                                                            class="btn btn-secondary btn-circle"><i
                                                                class="bi bi-info-circle-fill"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $vacancy->judul_lowongan }}</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td class="d-flex gap-1">

                                                    <a href="{{ route('vacancy.show', ['vacancy' => $vacancy->id]) }}"
                                                        class="btn btn-secondary btn-circle"><i
                                                            class="bi bi-info-circle-fill"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>


                            </table>
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
                            title: 'Data Criteria',
                        },
                        {
                            extend: 'csvHtml5',
                            title: 'Data Criteria',
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Criteria',
                            orientation: 'portrait',
                            pageSize: 'A4',
                        },
                        {
                            extend: 'print',
                            title: 'Data Criteria',
                        }
                    ]
                });

                tinymce.init({
                    selector: '#deskripsi_lowongan',
                    height: 200,
                    plugins: 'lists link image code',
                    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
                    menubar: false,

                });

                $('.btn-hapus').on('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(e.target).closest('form').submit();
                        }
                    });
                });

            });
        </script>

    </main>
</x-admin.layout.layout>
