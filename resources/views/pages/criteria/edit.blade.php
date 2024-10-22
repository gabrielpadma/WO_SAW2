<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Data Criteria</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('criteria.index') }}">Criteria</a> </li>
                    <li class="breadcrumb-item">{{ $criterion->id }}</li>
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Criteria</h5>
                            <form action="{{ route('criteria.update', ['criterion' => $criterion->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="vacancy_id" class="form-label">Lowongan</label>
                                            <select name="vacancy_id" id="vacancy_id" @class(['form-control ', 'is-invalid' => $errors->has('vacancy_id')])
                                                required>
                                                <option value="">-- Pilih Lowongan --</option>
                                                @foreach ($allVacancies as $vacancy)
                                                    <option value="{{ $vacancy->id }}"
                                                        {{ old('vacancy_id', $criterion->vacancy->id) == $vacancy->id ? 'selected' : '' }}>
                                                        {{ ucfirst($vacancy->judul_lowongan) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('vacancy_id')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="nama_criteria" class="form-label">Nama Criteria</label>
                                                <input type="text" @class([
                                                    'form-control ',
                                                    'is-invalid' => $errors->has('nama_criteria'),
                                                ]) id="nama_criteria"
                                                    name="nama_criteria" aria-describedby="judulLowongan"
                                                    value="{{ old('nama_criteria', $criterion->nama_criteria) }}">
                                                @error('nama_criteria')
                                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="bobot" class="form-label">Bobot Criteria</label>
                                                <input type="number" @class(['form-control ', 'is-invalid' => $errors->has('bobot')]) id="bobot"
                                                    name="bobot" aria-describedby="judulLowongan"
                                                    value="{{ old('bobot', $criterion->bobot) }}">
                                                @error('bobot')
                                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group mb-2">
                                                <label for="attachment" class="form-label">Jenis Criteria</label>
                                                <select name="jenis_criteria" id="jenis_criteria" class="form-control">
                                                    <option value="">-- Pilih Jenis Criteria --</option>

                                                    @foreach (App\JenisCriteria::cases() as $criterionType)
                                                        <option value="{{ $criterionType->value }}"
                                                            {{ old('jenis_criteria', $criterion->jenis_criteria->value) == $criterionType->value ? 'selected' : '' }}>
                                                            {{ ucfirst($criterionType->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('jenis_criteria')
                                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
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
