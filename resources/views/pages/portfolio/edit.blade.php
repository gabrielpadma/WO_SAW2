<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Data Portfolio</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"> <a href="{{ route('portfolio.index') }}">Portfolio</a> </li>
                    <li class="breadcrumb-item">{{ $portfolio->id }}</li>
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Portfolio</h5>
                            <form action="{{ route('portfolio.update', ['portfolio' => $portfolio->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="portfolio_title" class="form-label">Judul Portfolio</label>
                                            <input type="text" @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('portfolio_title'),
                                            ]) id="portfolio_title"
                                                name="portfolio_title" aria-describedby="judulportfolio"
                                                value="{{ old('portfolio_title', $portfolio->portfolio_title) }}">
                                            @error('portfolio_title')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="client_name" class="form-label">Nama Client</label>
                                            <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('client_name')]) id="client_name"
                                                name="client_name" aria-describedby="judulLowongan" required
                                                value="{{ old('client_name', $portfolio->client_name) }}">
                                            @error('client_name')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="project_date" class="form-label">Tanggal Project</label>
                                            <input type="date" @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('project_date'),
                                            ]) id="project_date"
                                                name="project_date" aria-describedby="judulLowongan" required
                                                value="{{ old('project_date', $portfolio->project_date) }}">
                                            @error('project_date')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="google_maps_url" class="form-label">Lokasi Project</label>
                                            <input type="text" @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('google_maps_url'),
                                            ]) id="google_maps_url"
                                                name="google_maps_url" aria-describedby="judulLowongan" required
                                                value="{{ old('google_maps_url', $portfolio->google_maps_url) }}">
                                            @error('google_maps_url')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="portfolio_detail_desc" class="form-label">Deskripsi
                                                Detail</label>
                                            <textarea id="portfolio_detail_desc" name="portfolio_detail_desc" required>
                                            {{ old('portfolio_detail_desc', $portfolio->portfolio_detail_desc) }}
                                        </textarea>
                                            @error('portfolio_detail_desc')
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
                                                'is-invalid' => $errors->has('portfolio_thumbnail'),
                                            ]) type="file" id="attachment"
                                                name="portfolio_thumbnail">
                                            <div
                                                class="d-flex berkas_persyaratan align-items-center justify-content-center">
                                                @if (Str::endsWith($portfolio->portfolio_thumbnail, '.pdf'))
                                                    <embed class="pdf-preview" id="pdf-preview"
                                                        src="{{ Storage::url($portfolio->portfolio_thumbnail) }}"
                                                        type="application/pdf"
                                                        style=" margin-top:10px; width: 100%; height: 500px;" />
                                                @else
                                                    <img class="attachment-preview" id="attachment-preview"
                                                        src="{{ Storage::url($portfolio->portfolio_thumbnail) }}"
                                                        alt="Preview Image"
                                                        style=" margin-top:10px; max-width: 100%; height: auto;">
                                                @endif
                                            </div>
                                            @error('portfolio_thumbnail')
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
                    selector: '#portfolio_detail_desc', // Target textarea
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
