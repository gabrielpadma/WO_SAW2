<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Testimoial Pelanggan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Testimonial</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <button type="button" class="btn btn-primary btn-icon-split ms-2 mb-3" data-bs-toggle="modal"
            data-bs-target="#modalTambahData">
            <i class="bi bi-plus-lg"></i>
            <span>
                Tambah Testimonial
            </span>

        </button>


        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Testimonial</h5>
                            <div style="overflow-x: auto;">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Client Name</th>
                                            <th>Thumbnail</th>
                                            <th>Tanggal Project</th>
                                            <th>Lokasi Project</th>
                                            <th>Deskripsi Project</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($allPortfolio as $portfolio)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $portfolio->portfolio_title }}</td>
                                                <td>{{ $portfolio->client_name }}</td>
                                                <td><a href="{{ Storage::url($portfolio->portfolio_thumbnail) }}"
                                                        target="blank"><i class="bi bi-file-earmark-text-fill"></i></a>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($portfolio->project_date)->isoFormat('D MMMM Y') }}
                                                </td>
                                                <td>{!! $portfolio->google_maps_url !!}</td>
                                                <td>{!! $portfolio->portfolio_detail_desc !!}</td>
                                                <td class="d-flex gap-1">
                                                    <a href="{{ route('portfolio.edit', ['portfolio' => $portfolio->id]) }}"
                                                        class="btn btn-primary btn-circle"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    <a href="{{ route('portfolio.portfolio-detail.index', ['portfolio' => $portfolio->id]) }}"
                                                        class="btn btn-secondary btn-circle"><i
                                                            class="bi bi-info-circle-fill"></i></a>
                                                    <form
                                                        action="{{ route('portfolio.destroy', ['portfolio' => $portfolio->id]) }}"
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

                                <!-- End Table with stripped rows -->

                            </div>
                        </div>


                    </div>
                </div>
        </section>

        <x-modal title="Tambah Data Portfolio" idModal="modalTambahData">
            <form action="{{ route('portfolio.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="portfolio_title" class="form-label">Judul Portfolio</label>
                    <input type="text" @class([
                        'form-control ',
                        'is-invalid' => $errors->has('portfolio_title'),
                    ]) id="portfolio_title" name="portfolio_title"
                        aria-describedby="judulLowongan" required value="{{ old('portfolio_title') }}">
                    @error('portfolio_title')
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

                <div class="mb-3">
                    <label for="portfolio_detail_desc" class="form-label">Deskripsi Detail</label>
                    <textarea id="portfolio_detail_desc" name="portfolio_detail_desc" required>
                    {{ old('portfolio_detail_desc') }}
                </textarea>
                    @error('portfolio_detail_desc')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>



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
                    <label for="client_name" class="form-label">Nama Client</label>
                    <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('client_name')]) id="client_name" name="client_name"
                        aria-describedby="judulLowongan" required value="{{ old('client_name') }}">
                    @error('client_name')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3 ">
                    <label for="portfolio_thumbnail" class="form-label">Portfolio Thumbnail</label>
                    <input @class([
                        'form-control ',
                        'is-invalid' => $errors->has('portfolio_thumbnail'),
                    ]) type="file" id="portfolio_thumbnail"
                        name="portfolio_thumbnail" required>
                    <div class="imgPreviewWrapper d-flex justify-content-center">
                        <img id="attachment-preview" src="" alt="Preview Image"
                            style="display:none; margin-top:10px; max-width: 100%; height: auto;">
                    </div>
                    @error('portfolio_thumbnail')
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


                document.getElementById('portfolio_thumbnail').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const previewImage = document.getElementById('attachment-preview');

                    if (file) {
                        const fileType = file.type;

                        previewImage.style.display = 'none';
                        previewImage.src = '';

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                            previewImage.style.display = 'block';
                        };
                        reader.readAsDataURL(file);

                    }
                });
            });
        </script>

    </main>
</x-admin.layout.layout>
