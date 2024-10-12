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
                                        <th>
                                            <b>N</b>ame
                                        </th>
                                        <th>Ext.</th>
                                        <th>City</th>
                                        <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                        <th>Completion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Unity Pugh</td>
                                        <td>9958</td>
                                        <td>Curicó</td>
                                        <td>2005/02/11</td>
                                        <td>37%</td>
                                    </tr>



                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <x-modal title="Tambah Data Lowongan">
            <form action="{{ route('vacancy.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="judul_lowongan" class="form-label">Judul Lowongan</label>
                    <input type="text" class="form-control" id="judul_lowongan" name="judul_lowongan"
                        aria-describedby="judulLowongan" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi_lowongan" class="form-label">Deskripsi Lowongan</label>
                    <textarea class="tinymce-editor" name="deskripsi_lowongan" required>
                    </textarea>
                </div>
                <div class="mb-3 ">
                    <label for="attachment" class="form-label">Lampiran</label>
                    <input class="form-control" type="file" id="attachment" name="berkas_persyaratan" required>
                    <img id="attachment-preview" src="" alt="Preview Image"
                        style="display:none; margin-top:10px; max-width: 100%; height: auto;">
                    <embed id="pdf-preview" src="" type="application/pdf"
                        style="display:none; margin-top:10px; width: 100%; height: 500px;" />
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </x-modal>


        @if ($errors->any())
            <script>
                Swal.fire({
                    title: 'Validation Error!',
                    html: @foreach ($errors->all() as $error)
                        '<span class="text-sm text-danger">{{ $error }}</span><br>' +
                    @endforeach
                    '',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif



        <script>
            $(document).ready(function() {

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
