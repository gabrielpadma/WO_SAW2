<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Data Lowongan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"> <a href="{{ route('vacancy.index') }}">Lowongan</a> </li>
                    <li class="breadcrumb-item">{{ $vacancy->id }}</li>
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Lowongan</h5>
                            <form action="{{ route('vacancy.update', ['vacancy' => $vacancy->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="judul_lowongan" class="form-label">Judul
                                                Lowongan</label>
                                            <input type="text" @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('judul_lowongan'),
                                            ]) id="judul_lowongan"
                                                name="judul_lowongan" aria-describedby="judulLowongan"
                                                value="{{ old('judul_lowongan', $vacancy->judul_lowongan) }}">
                                            @error('judul_lowongan')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-6">
                                            <label for="deskripsi_lowongan" class="form-label">Deskripsi
                                                Lowongan</label>
                                            <textarea id="deskripsi_lowongan" name="deskripsi_lowongan">
                                            {{ old('deskripsi_lowongan', $vacancy->deskripsi_lowongan) }}
                                            </textarea>

                                            @error('deskripsi_lowongan')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="attachment" class="form-label ">Lampiran</label>
                                            <input @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('berkas_persyaratan'),
                                            ]) type="file" id="attachment"
                                                name="berkas_persyaratan">
                                            <div
                                                class="d-flex berkas_persyaratan align-items-center justify-content-center">
                                                @if (Str::endsWith($vacancy->berkas_persyaratan, '.pdf'))
                                                    <embed class="pdf-preview" id="pdf-preview"
                                                        src="{{ Storage::url($vacancy->berkas_persyaratan) }}"
                                                        type="application/pdf"
                                                        style=" margin-top:10px; width: 100%; height: 500px;" />
                                                @else
                                                    <img class="attachment-preview" id="attachment-preview"
                                                        src="{{ Storage::url($vacancy->berkas_persyaratan) }}"
                                                        alt="Preview Image"
                                                        style=" margin-top:10px; max-width: 100%; height: auto;">
                                                @endif
                                            </div>
                                            @error('berkas_persyaratan')
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
                    selector: '#deskripsi_lowongan', // Target textarea
                    height: 200, // Tinggi editor
                    plugins: 'lists link image code', // Tambahkan plugin sesuai kebutuhan
                    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
                    menubar: false, // Menyembunyikan menubar (opsional)

                });

                $('#attachment').on('change', function(event) {
                    const file = event.target.files[0];

                    // Hapus elemen preview yang ada sebelumnya
                    $('#attachment-preview').remove();
                    $('#pdf-preview').remove();

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
                                $('.berkas_persyaratan').html(imgEl);
                            };
                            reader.readAsDataURL(file);
                        } else if (fileType === 'application/pdf') {
                            // Preview untuk PDF
                            const fileURL = URL.createObjectURL(file);

                            // Tambahkan elemen PDF baru
                            const embedEl = $('<embed>', {
                                id: 'pdf-preview',
                                src: fileURL,
                                type: 'application/pdf',
                                class: 'pdf-preview',
                                css: {
                                    'width': '25%',
                                    'height': '500px',
                                    'margin-top': '10px'
                                }
                            }); // Menambahkannya ke dalam form group
                            $('.berkas_persyaratan').html(embedEl);
                        }
                    }
                });

            });
        </script>

    </main>
</x-admin.layout.layout>
