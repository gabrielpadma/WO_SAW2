<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Semua Sub Criteria {{ $criterion->nama_criteria }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('criteria.index') }}">Criteria</a></li>
                    <li class="breadcrumb-item">{{ $criterion->id }}</li>
                    <li class="breadcrumb-item active">Sub Criteria</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <button type="button" class="btn btn-primary btn-icon-split ms-2 mb-3" data-bs-toggle="modal"
            data-bs-target="#modalTambahData">
            <i class="bi bi-plus-lg"></i>
            <span>
                Tambah Sub Criteria
            </span>

        </button>


        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Criteria</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kriteria</th>
                                        <th>Nama Sub Kriteria</th>
                                        <th>Nilai Alternatif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allSubCriteria as $subCriteria)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $criterion->nama_criteria }}</td>
                                            <td>{{ $subCriteria->sub_criteria_name }}</td>
                                            <td>{{ $subCriteria->value }}</td>
                                            </td>
                                            <td class="d-flex gap-1">
                                                <a href="{{ route('criteria.sub-criteria.edit', ['criterion' => $criterion->id, 'sub_criterion' => $subCriteria->id]) }}"
                                                    class="btn btn-primary btn-circle"><i
                                                        class="bi bi-pencil-square"></i></a>

                                                <form
                                                    action="{{ route('criteria.sub-criteria.destroy', ['criterion' => $criterion->id, 'sub_criterion' => $subCriteria->id]) }}"
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

        <x-modal title="Tambah Data Sub Criteria" idModal="modalTambahData">
            <form action="{{ route('criteria.sub-criteria.store', ['criterion' => $criterion->id]) }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="sub_criteria_name" class="form-label">Nama Sub Criteria</label>
                    <input type="text" @class([
                        'form-control ',
                        'is-invalid' => $errors->has('sub_criteria_name'),
                    ]) id="sub_criteria_name" name="sub_criteria_name"
                        aria-describedby="judulLowongan" required value="{{ old('sub_criteria_name') }}">
                    @error('sub_criteria_name')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="value" class="form-label">Bobot Sub Criteria</label>
                    <input type="number" @class(['form-control ', 'is-invalid' => $errors->has('value')]) id="value" name="value"
                        aria-describedby="value" required value="{{ old('value') }}" min="1" max="100">
                    <p class="small text-danger">Nilai sub kriteria memiliki rentang 1-100</p>
                    @error('value')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </x-modal>


        @if ($errors->any())
            <script>
                const myModal = new bootstrap.Modal(document.getElementById('modalTambahData'));
                myModal.show();
            </script>
        @endif



        <script>
            $(document).ready(function() {

                $('.datatable').DataTable({
                    dom: 'Bfrtip', // Mengaktifkan tombol export
                    buttons: [{
                            extend: 'excelHtml5',
                            title: 'Data Sub Criteria',
                        },
                        {
                            extend: 'csvHtml5',
                            title: 'Data Sub Criteria',
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Sub Criteria',
                            orientation: 'portrait',
                            pageSize: 'A4',
                        },
                        {
                            extend: 'print',
                            title: 'Data Sub Criteria',
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
