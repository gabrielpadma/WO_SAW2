<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Lowongan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Lowongan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <button type="button" class="btn btn-primary btn-icon-split ms-2 mb-3" data-bs-toggle="modal"
            data-bs-target="#modalTambahData">
            <i class="bi bi-plus-lg"></i>
            <span>
                Tambah Lowongan
            </span>

        </button>


        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Lowongan</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Lowongan</th>
                                        <th>Deskripsi Lowongan</th>
                                        <th>Berkas Lowongan</th>
                                        <th data-type="date" data-format="YYYY/DD/MM">Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allVacancies as $vacancy)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $vacancy->judul_lowongan }}</td>
                                            <td>{!! $vacancy->deskripsi_lowongan !!}</td>
                                            <td><a href="{{ Storage::url($vacancy->berkas_persyaratan) }}"
                                                    target="blank"><i class="bi bi-file-earmark-text-fill"></i></a>
                                            </td>
                                            <td>{{ $vacancy->created_at->format('d-m-Y H:i') }}</td>
                                            <td class="d-flex gap-1">
                                                <a href="{{ route('vacancy.edit', ['vacancy' => $vacancy->id]) }}"
                                                    class="btn btn-primary btn-circle"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <form
                                                    action="{{ route('vacancy.destroy', ['vacancy' => $vacancy->id]) }}"
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
            <form action="{{ route('vacancy.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="judul_lowongan" class="form-label">Judul Lowongan</label>

                    <input type="text" @class([
                        'form-control ',
                        'is-invalid' => $errors->has('judul_lowongan'),
                    ]) id="judul_lowongan" name="judul_lowongan"
                        aria-describedby="judulLowongan" required value="{{ old('judul_lowongan') }}">
                    @error('judul_lowongan')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi_lowongan" class="form-label">Deskripsi Lowongan</label>
                    <textarea id="deskripsi_lowongan" name="deskripsi_lowongan" required>
                        {{ old('deskripsi_lowongan') }}
                    </textarea>
                    @error('deskripsi_lowongan')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 ">
                    <label for="attachment" class="form-label">Lampiran</label>
                    <input @class([
                        'form-control ',
                        'is-invalid' => $errors->has('berkas_persyaratan'),
                    ]) type="file" id="attachment" name="berkas_persyaratan"
                        required>
                    <img id="attachment-preview" src="" alt="Preview Image"
                        style="display:none; margin-top:10px; max-width: 100%; height: auto;">
                    <embed id="pdf-preview" src="" type="application/pdf"
                        style="display:none; margin-top:10px; width: 100%; height: 500px;" />
                    @error('berkas_persyaratan')
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


                document.getElementById('attachment').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const previewImage = document.getElementById('attachment-preview');
                    const previewPDF = document.getElementById('pdf-preview');

                    if (file) {
                        const fileType = file.type;

                        // Reset the previews
                        previewImage.style.display = 'none';
                        previewPDF.style.display = 'none';
                        previewImage.src = '';
                        previewPDF.src = '';

                        if (fileType.startsWith('image/')) {
                            // Preview for image
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                previewImage.src = e.target.result;
                                previewImage.style.display = 'block';
                            };
                            reader.readAsDataURL(file);
                        } else if (fileType === 'application/pdf') {
                            // Preview for PDF
                            const fileURL = URL.createObjectURL(file);
                            previewPDF.src = fileURL;
                            previewPDF.style.display = 'block';
                        }
                    }
                });
            });
        </script>

    </main>
</x-admin.layout.layout>
