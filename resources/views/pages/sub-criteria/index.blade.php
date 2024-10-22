<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Sub Criteria</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
                            <h5 class="card-title">Tabel Sub Criteria</h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Criteria</th>
                                        <th>Sub Criteria</th>
                                        <th>Nilai</th>

                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allCriteria as $criteria)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>C{{ $loop->iteration }}</td>
                                            <td>{{ $criteria->nama_criteria }}</td>
                                            <td>{{ $criteria->bobot }}</td>
                                            <td>{{ $criteria->jenis_criteria }}</a>
                                            </td>
                                            <td class="d-flex gap-1">
                                                <a href="{{ route('criteria.edit', ['criterion' => $criteria->id]) }}"
                                                    class="btn btn-primary btn-circle"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <form
                                                    action="{{ route('criteria.destroy', ['criterion' => $criteria->id]) }}"
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

        <x-modal title="Tambah Data Lowongan" idModal="modalTambahData">
            <form action="{{ route('criteria.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_criteria" class="form-label">Nama Criteria</label>
                    <input type="text" @class([
                        'form-control ',
                        'is-invalid' => $errors->has('nama_criteria'),
                    ]) id="nama_criteria" name="nama_criteria"
                        aria-describedby="judulLowongan" required value="{{ old('judul_lowongan') }}">
                    @error('nama_criteria')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="bobot" class="form-label">Bobot Criteria</label>
                    <input type="number" @class(['form-control ', 'is-invalid' => $errors->has('bobot')]) id="bobot" name="bobot"
                        aria-describedby="bobot" required value="{{ old('bobot') }}">
                    @error('bobot')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
                <div class="mb-3 ">
                    <label for="attachment" class="form-label">Jenis Criteria</label>
                    <select name="jenis_criteria" id="jenis_criteria" class="form-control">
                        <option value="">-- Pilih Jenis Criteria --</option>
                        @foreach (App\JenisCriteria::cases() as $criterionType)
                            <option value="{{ $criterionType->value }}"
                                {{ old('jenis_criteria') == $criterionType->value ? 'selected' : '' }}>
                                {{ ucfirst($criterionType->name) }}
                            </option>
                        @endforeach
                    </select>
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
