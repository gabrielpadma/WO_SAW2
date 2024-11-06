<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Data Testimonial</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"> <a href="{{ route('testimonial.index') }}">Testimonial</a> </li>
                    <li class="breadcrumb-item">{{ $testimonial->id }}</li>
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Testimonial</h5>
                            <form action="{{ route('testimonial.update', ['testimonial' => $testimonial->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="testimonial_customer_name" class="form-label">Nama
                                                Customer</label>
                                            <input type="text" @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('testimonial_customer_name'),
                                            ])
                                                id="testimonial_customer_name" name="testimonial_customer_name"
                                                aria-describedby="judulLowongan" required
                                                value="{{ old('testimonial_customer_name', $testimonial->testimonial_customer_name) }}">
                                            @error('testimonial_customer_name')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-6">
                                            <label for="testimonial_desc" class="form-label">Deskripsi
                                                Testimonial</label>
                                            <textarea id="testimonial_desc" name="testimonial_desc" required>
                                            {{ old('testimonial_desc', $testimonial->testimonial_desc) }}
                                        </textarea>
                                            @error('testimonial_desc')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="testimonial_image" class="form-label ">Gambar
                                                Testimonial</label>
                                            <input @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('testimonial_image'),
                                            ]) type="file" id="testimonial_image"
                                                name="testimonial_image">
                                            <div
                                                class="d-flex testimonial_image align-items-center justify-content-center">
                                                <img class="attachment-preview" id="attachment-preview"
                                                    src="{{ Storage::url($testimonial->testimonial_image) }}"
                                                    alt="Preview Image"
                                                    style=" margin-top:10px; max-width: 100%; height: auto;">

                                            </div>
                                            @error('testimonial_image')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>



        <script>
            $(document).ready(function() {

                tinymce.init({
                    selector: '#testimonial_desc', // Target textarea
                    height: 200, // Tinggi editor
                    plugins: 'lists link image code', // Tambahkan plugin sesuai kebutuhan
                    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
                    menubar: false, // Menyembunyikan menubar (opsional)

                });

                $('#testimonial_image').on('change', function(event) {
                    console.log('on change');
                    const file = event.target.files[0];

                    // Hapus elemen preview yang ada sebelumnya
                    $('#attachment-preview').remove();
                    if (file) {
                        const fileType = file.type;

                        if (fileType.startsWith('image/')) {
                            // Preview untuk gambar
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                // Tambahkan elemen gambar baru
                                const imgEl = $('<img>', {
                                    id: 'attachment-preview',
                                    src: e.target.result,
                                    class: 'attachment-preview',
                                    css: {
                                        'max-width': '25%',
                                        'height': 'auto',
                                        'margin-top': '10px'
                                    }
                                }); // Menambahkannya ke dalam form group
                                $('.testimonial_image').html(imgEl);
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                });

            });
        </script>

    </main>
</x-admin.layout.layout>
