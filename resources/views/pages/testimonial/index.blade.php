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
                                            <th>Gambar Testimonial</th>
                                            <th>Nama Customer</th>
                                            <th>Deskripsi Testimonial</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($allTestimonial as $testimonial)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="{{ Storage::url($testimonial->testimonial_image) }}"
                                                        target="blank"><i class="bi bi-file-earmark-text-fill"></i></a>
                                                </td>
                                                <td>{{ $testimonial->testimonial_customer_name }}</td>
                                                <td>{!! $testimonial->testimonial_desc !!}</td>
                                                <td>{{ \Carbon\Carbon::parse($testimonial->created_at)->isoFormat('D MMMM Y') }}
                                                </td>
                                                <td class="d-flex gap-1">
                                                    <a href="{{ route('testimonial.edit', ['testimonial' => $testimonial->id]) }}"
                                                        class="btn btn-primary btn-circle"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    <form
                                                        action="{{ route('testimonial.destroy', ['testimonial' => $testimonial->id]) }}"
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

        <x-modal title="Tambah Data Testimonial" idModal="modalTambahData">
            <form action="{{ route('testimonial.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="testimonial_customer_name" class="form-label">Nama Customer</label>
                    <input type="text" @class([
                        'form-control ',
                        'is-invalid' => $errors->has('testimonial_customer_name'),
                    ]) id="testimonial_customer_name"
                        name="testimonial_customer_name" aria-describedby="judulLowongan" required
                        value="{{ old('testimonial_customer_name') }}">
                    @error('testimonial_customer_name')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="testimonial_desc" class="form-label">Deskripsi Testimonial</label>
                    <textarea id="testimonial_desc" name="testimonial_desc" required>
                    {{ old('testimonial_desc') }}
                </textarea>
                    @error('testimonial_desc')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 ">
                    <label for="testimonial_image" class="form-label">Gambar Testimonial</label>
                    <input @class([
                        'form-control ',
                        'is-invalid' => $errors->has('testimonial_image'),
                    ]) type="file" id="testimonial_image" name="testimonial_image"
                        required>
                    <div class="imgPreviewWrapper d-flex justify-content-center">
                        <img id="attachment-preview" src="" alt="Preview Image"
                            style="display:none; margin-top:10px; max-width: 100%; height: auto;">
                    </div>
                    @error('testimonial_image')
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
                            title: 'Data Testimonials',
                        },
                        {
                            extend: 'csvHtml5',
                            title: 'Data Testimonials',
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Testimonials',
                            orientation: 'portrait',
                            pageSize: 'A4',
                        },
                        {
                            extend: 'print',
                            title: 'Data Testimonials',
                        }
                    ]
                });


                tinymce.init({
                    selector: '#testimonial_desc',
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


                document.getElementById('testimonial_image').addEventListener('change', function(event) {
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
