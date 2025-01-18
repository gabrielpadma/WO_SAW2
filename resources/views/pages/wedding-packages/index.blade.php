<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Paket Wedding</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Paket Wedding</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <button type="button" class="btn btn-primary btn-icon-split ms-2 mb-3" data-bs-toggle="modal"
            data-bs-target="#modalTambahData">
            <i class="bi bi-plus-lg"></i>
            <span>
                Tambah Paket
            </span>

        </button>


        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Paket Wedding</h5>
                            <div style="overflow-x: auto;">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Paket</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Rekomendasi</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allWeddingPackage as $package)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $package->package_title }}
                                                </td>
                                                <td>{{ 'Rp ' . number_format($package->price, 0, ',', '.') }}</td>
                                                <td>{{ $package->is_active ? 'Aktif' : 'Non Aktif' }}</td>
                                                <td>{{ $package->is_recommend ? 'Ya' : 'Tidak' }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($package->created_at)->isoFormat('D MMMM Y') }}
                                                </td>
                                                <td class="d-flex gap-1">
                                                    <a href="{{ route('wedding-package.edit', ['wedding_package' => $package->id]) }}"
                                                        class="btn btn-primary btn-circle"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    <form
                                                        action="{{ route('wedding-package.destroy', ['wedding_package' => $package->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-circle btn-hapus">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <x-modal title="Tambah Data Paket" idModal="modalTambahData">
            <form action="{{ route('wedding-package.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="package_title" class="form-label">Judul Paket</label>
                    <input type="text" @class([
                        'form-control ',
                        'is-invalid' => $errors->has('package_title'),
                    ]) id="package_title" name="package_title"
                        aria-describedby="judulPaket" required value="{{ old('package_title') }}">
                    @error('package_title')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>



                <div class="mb-3">
                    <label for="features" class="form-label">Fitur</label>
                    <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('features')]) id="features" name="features"
                        aria-describedby="features" required value="{{ old('features') }}"
                        placeholder="Pisahkan dengan tanda ','">
                    @error('features')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('price')]) id="price" name="price"
                        aria-describedby="price" required value="{{ old('price') }}">
                    @error('price')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="is_active">
                        <option value="">-- Pilih Status --</option>
                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Non Aktif</option>
                    </select>
                    @error('is_active')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="is_recommed" class="form-label">Rekomendasi</label>
                    <select class="form-select" aria-label="Default select example" name="is_recommend">
                        <option value="">-- Jadikan Rekomendasi --</option>
                        <option value="1" {{ old('is_recommed') == '1' ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ old('is_recommed') == '0' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @error('is_recommend')
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
                            title: 'Data Paket Wedding',
                        },
                        {
                            extend: 'csvHtml5',
                            title: 'Data Paket Wedding',
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Paket Wedding',
                            orientation: 'portrait',
                            pageSize: 'A4',
                        },
                        {
                            extend: 'print',
                            title: 'Data Paket Wedding',
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


                $('#price').on('keyup', function(e) {
                    let value = $(this).val().replace(/[^,\d]/g, '');
                    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    $(this).val(value);
                });
            });
        </script>

    </main>
</x-admin.layout.layout>
