<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Portfolio {{ $portfolio->portfolio_title }}</h1>
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
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Portfolio</th>
                                        <th>Nama Client</th>
                                        <th>Tanggal Project</th>
                                        <th>Deskripsi</th>
                                        <th>Google Maps Url</th>
                                        <th>Detail Image 1</th>
                                        <th>Detail Image 2</th>
                                        <th>Detail Image 3</th>
                                        <th>Detail Image 4</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($portfolio->portfolio_details as $detail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $portfolio->portfolio_title }}</td>
                                            <td>{{ $detail->client_name }}</td>
                                            <td>{{ $detail->project_date }}</td>
                                            <td>{{ $detail->portfolio_detai_desc }}</td>
                                            <td>{{ $detail->detail_image1 }}</td>
                                            <td>{{ $detail->detail_image2 }}</td>
                                            <td>{{ $detail->detail_image3 }}</td>
                                            <td>{{ $detail->detail_image4 }}</td>
                                            <td class="d-flex gap-1">
                                                <a href="{{ route('portfolio.portfolio-detail.edit', ['portfolio' => $portfolio->id, 'portfolio-detail' => $detail->id]) }}"
                                                    class="btn btn-primary btn-circle"><i
                                                        class="bi bi-pencil-square"></i></a>

                                                <form
                                                    action="{{ route('portfolio.portfolio-detail.destroy', ['portfolio' => $portfolio->id, 'portfolio-detail' => $detail->id]) }}"
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


        <x-modal title="Tambah Data Detail Portofolio" idModal="modalTambahData">
            <form action="{{ route('portfolio.portfolio-detail.store', ['portfolio' => $portfolio->id]) }}"
                method="post">
                @csrf

                <div class="mb-3">
                    <label for="client_name" class="form-label">Nama Client</label>
                    <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('client_name')]) id="client_name" name="client_name"
                        aria-describedby="judulLowongan" required value="{{ old('client_name') }}">
                    @error('client_name')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="project_date" class="form-label">Tanggal Project</label>
                    <input type="date" @class([
                        'form-control ',
                        'is-invalid' => $errors->has('project_date'),
                    ]) id="project_date" name="project_date"
                        aria-describedby="judulLowongan" required value="{{ old('project_date') }}">
                    @error('project_date')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <label for="portfolio_detail_desc" class="form-label">Deskripsi Detail</label>
                <textarea id="portfolio_detail_desc" name="portfolio_detail_desc" required>
                    {{ old('portfolio_detail_desc') }}
                </textarea>
                @error('portfolio_detail_desc')
                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="google_maps_url" class="form-label">Lokasi Project</label>
                    <input type="text" @class([
                        'form-control ',
                        'is-invalid' => $errors->has('google_maps_url'),
                    ]) id="google_maps_url" name="google_maps_url"
                        aria-describedby="judulLowongan" required value="{{ old('google_maps_url') }}">
                    @error('google_maps_url')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="detail_image1" class="form-label">Gambar Detail 1</label>
                    <input @class([
                        'form-control ',
                        'is-invalid' => $errors->has('detail_image1'),
                    ]) type="file" id="detail_image1" name="detail_image1">
                </div>
                <div class="mb-3">
                    <label for="detail_image2" class="form-label">Gambar Detail 2</label>
                    <input @class([
                        'form-control ',
                        'is-invalid' => $errors->has('detail_image2'),
                    ]) type="file" id="detail_image2" name="detail_image2">
                </div>
                <div class="mb-3">
                    <label for="detail_image3" class="form-label">Gambar Detail 3</label>
                    <input @class([
                        'form-control ',
                        'is-invalid' => $errors->has('detail_image3'),
                    ]) type="file" id="detail_image3" name="detail_image3">
                </div>
                <div class="mb-3">
                    <label for="detail_image4" class="form-label">Gambar Detail 4</label>
                    <input @class([
                        'form-control ',
                        'is-invalid' => $errors->has('detail_image4'),
                    ]) type="file" id="detail_image4" name="detail_image4">
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
