<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>

    <style>
        iframe {
            height: 50%;
            width: auto;
        }
    </style>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Portfolio {{ $portfolio?->portfolio_title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item "><a href="{{ route('portfolio.index') }}">Portfolio </a></li>
                    <li class="breadcrumb-item ">{{ $portfolio->id }}</li>
                    <li class="breadcrumb-item active">Portfolio Details</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <button type="button" class="btn btn-primary btn-icon-split ms-2 mb-3" data-bs-toggle="modal"
            data-bs-target="#modalTambahData">
            <i class="bi bi-plus-lg"></i>
            <span>
                Tambah Detail Portfolio
            </span>

        </button>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Portfolio Details</h5>
                            <!-- Table with stripped rows -->
                            <div style="overflow-x: auto;">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Detail Image 1</th>
                                            <th>Detail Image 2</th>
                                            <th>Detail Image 3</th>
                                            <th>Detail Image 4</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($portfolio?->portfolio_details && $portfolio->portfolio_details->count() > 0)

                                            @foreach ($portfolio->portfolio_details as $detail)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>

                                                    <td>
                                                        @if ($detail->detail_image1 && Storage::exists('public/' . $detail->detail_image1))
                                                            <a href="{{ Storage::url($detail->detail_image1) }}"
                                                                target="_blank">
                                                                <i class="bi bi-file-earmark-text-fill"></i>
                                                            </a>
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($detail->detail_image2 && Storage::exists('public/' . $detail->detail_image2))
                                                            <a href="{{ Storage::url($detail->detail_image2) }}"
                                                                target="_blank">
                                                                <i class="bi bi-file-earmark-text-fill"></i>
                                                            </a>
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($detail->detail_image3 && Storage::exists('public/' . $detail->detail_image3))
                                                            <a href="{{ Storage::url($detail->detail_image3) }}"
                                                                target="_blank">
                                                                <i class="bi bi-file-earmark-text-fill"></i>
                                                            </a>
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($detail->detail_image4 && Storage::exists('public/' . $detail->detail_image4))
                                                            <a href="{{ Storage::url($detail->detail_image4) }}"
                                                                target="_blank">
                                                                <i class="bi bi-file-earmark-text-fill"></i>
                                                            </a>
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>

                                                    <td class="d-flex gap-1">
                                                        <a href="{{ route('portfolio.portfolio-detail.edit', ['portfolio' => $portfolio->id, 'portfolio_detail' => $detail->id]) }}"
                                                            class="btn btn-primary btn-circle">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>

                                                        <form
                                                            action="{{ route('portfolio.portfolio-detail.destroy', ['portfolio' => $portfolio->id, 'portfolio_detail' => $detail->id]) }}"
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
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">Data tidak tersedia.</td>
                                            </tr>
                                        @endif
                                    </tbody>


                                </table>
                            </div>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>
                </div>
            </div>
        </section>


        <x-modal title="Tambah Data Detail Portofolio" idModal="modalTambahData">
            <form action="{{ route('portfolio.portfolio-detail.store', ['portfolio' => $portfolio->id]) }}"
                method="post" enctype="multipart/form-data">
                @csrf


                <div class="mb-3">
                    <label for="detail_image1" class="form-label">Gambar Detail 1</label>
                    <input @class([
                        'form-control ',
                        'is-invalid' => $errors->has('detail_image1'),
                    ]) type="file" id="detail_image1" name="detail_image1">
                    @error('detail_image1')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="detail_image2" class="form-label">Gambar Detail 2</label>
                    <input @class([
                        'form-control ',
                        'is-invalid' => $errors->has('detail_image2'),
                    ]) type="file" id="detail_image2" name="detail_image2">
                    @error('detail_image2')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="detail_image3" class="form-label">Gambar Detail 3</label>
                    <input @class([
                        'form-control ',
                        'is-invalid' => $errors->has('detail_image3'),
                    ]) type="file" id="detail_image3" name="detail_image3">
                    @error('detail_image3')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="detail_image4" class="form-label">Gambar Detail 4</label>
                    <input @class([
                        'form-control ',
                        'is-invalid' => $errors->has('detail_image4'),
                    ]) type="file" id="detail_image4" name="detail_image4">
                    @error('detail_image4')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </x-modal>


        {{-- @if ($errors->any())
            <script>
                const myModal = new bootstrap.Modal(document.getElementById('modalTambahData'));
                myModal.show();
            </script>
        @endif --}}



        <script>
            $(document).ready(function() {


                $('.datatable').DataTable({
                    dom: 'Bfrtip', // Mengaktifkan tombol export
                    buttons: [{
                            extend: 'excelHtml5',
                            title: 'Data Detail Portfolio',
                        },
                        {
                            extend: 'csvHtml5',
                            title: 'Data Detail Portfolio',
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Detail Portfolio',
                            orientation: 'portrait',
                            pageSize: 'A4',
                        },
                        {
                            extend: 'print',
                            title: 'Data Detail Portfolio',
                        }
                    ]
                });

                tinymce.init({
                    selector: '#portfolio_detail_desc',
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
