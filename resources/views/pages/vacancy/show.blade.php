<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Periode Lowongan {{ $vacancy->name }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('vacancy.index') }}">Lowongan</a></li>
                    <li class="breadcrumb-item active">Periode Lowongan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <button type="button" class="btn btn-primary btn-icon-split ms-2 mb-3" data-bs-toggle="modal"
            data-bs-target="#modalTambahData">
            <i class="bi bi-plus-lg"></i>
            <span>
                Tambah Periode
            </span>
        </button>

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
                                            <td class="d-flex gap-1">
                                                <a href="{{ route('edit-periode', ['periode' => $periode->id]) }}"
                                                    class="btn btn-primary btn-circle"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <a href="{{ route('detail-periode', ['vacancy' => $vacancy->id, 'periode' => $periode->id]) }}"
                                                    class="btn btn-primary btn-secondary"><i
                                                        class="bi bi-info-square"></i></a>

                                                <form action="{{ route('hapus-periode', ['periode' => $periode->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-circle btn-hapus">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </form>

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

        <x-modal title="Tambah Data Periode" idModal="modalTambahData">
            <form action="{{ route('tambah-periode') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="vacancy_id" value="{{ $vacancy->id }}">

                <div class="mb-3">
                    <label for="tanggal_periode" class="form-label">Periode</label>

                    <input type="month" @class([
                        'form-control ',
                        'is-invalid' => $errors->has('tanggal_periode'),
                    ]) id="tanggal_periode" name="tanggal_periode"
                        aria-describedby="judulLowongan" required value="{{ old('tanggal_periode') }}">
                    @error('tanggal_periode')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </x-modal>



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
