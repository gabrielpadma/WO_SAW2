<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>

    <style>
        .custom-img {
            height: 50%;
            width: auto;
            object-fit: cover;
        }
    </style>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Pelamar</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('vacancy.index') }}">Lowongan</a></li>
                    <li class="breadcrumb-item ">{{ $vacancy->id }}</li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('data-lamaran.vacancy.periode', ['vacancy' => $vacancy->id]) }}">Periode</a>
                    </li>
                    <li class="breadcrumb-item ">{{ $periode->id }}</li>
                    <li class="breadcrumb-item active">Pelamar</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Pelamar</h5>
                            <!-- Table with stripped rows -->
                            <div class="overflow-auto">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelamar</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Usia</th>
                                            <th>Alamat</th>
                                            <th>No Hp</th>
                                            <th>Email</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Tanggal Melamar</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applications as $app)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $app->user->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($app->user->tanggal_lahir)->format('d-m-Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($app->user->tanggal_lahir)->age }}
                                                    tahun
                                                </td>
                                                <td>{{ $app->user->alamat }}</td>
                                                <td>{{ $app->user->no_hp }}</td>
                                                <td>{{ $app->user->email }}</td>
                                                <td>{{ $app->created_at->format('d-m-Y H:i') }}</td>
                                                <td>
                                                    @if ($app->applicant_scores->count() > 0)
                                                        <span class="badge bg-success">Data alternatif sudah
                                                            diisi</span>
                                                    @else
                                                        <span class="badge bg-warning">Data alternatif belum
                                                            diisi</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex gap-1">
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#detail-pelamar-{{ $app->id }}"
                                                        class="btn btn-primary btn-circle" data-toggle="tooltip"
                                                        data-placement="top" title="Detail Pelamar"><i
                                                            class="bi bi-zoom-in"></i></button>


                                                    <a href="{{ route('seleksi-pelamar', ['periode' => $app->periode->id, 'application' => $app->id]) }}"
                                                        class="btn btn-success btn-circle" data-toggle="tooltip"
                                                        data-placement="top" title="Seleksi Pelamar"><i
                                                            class="bi bi-pencil-square"></i></a>


                                                    <form
                                                        action="{{ route('hapus-pelamar', ['application' => $app->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-circle btn-hapus">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </form>


                                                    <x-modal title="Detail Pelamar"
                                                        idModal="detail-pelamar-{{ $app->id }}">
                                                        <div class="bordered-wrapper border">
                                                            <div
                                                                class="img-wrapper d-flex justify-content-center py-3 px-3">
                                                                <img src="{{ Storage::url($app->user->foto) }}"
                                                                    class="card-img-top img-fluid custom-img"
                                                                    alt="...">
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="container ">
                                                                    <table class="table table-striped">
                                                                        <tr>
                                                                            <th scope="row">Nama Lengkap</th>
                                                                            <td>:</td>
                                                                            <td>{{ $app->user->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Tempat, Tgl. Lahir</th>
                                                                            <td>:</td>
                                                                            <td>{{ $app->user->tempat_lahir }},{{ \Carbon\Carbon::parse($app->user->tanggal_lahir)->format('d-m-Y') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Usia</th>
                                                                            <td>:</td>
                                                                            <td>{{ \Carbon\Carbon::parse($app->user->tanggal_lahir)->age }}
                                                                                tahun
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Jenis Kelamin</th>
                                                                            <td>:</td>
                                                                            <td>{{ $app->user->jenis_kelamin }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Status Pernikahan</th>
                                                                            <td>:</td>
                                                                            <td>{{ ($app->user->status_pernikahan == 'belum_menikah' ? 'Belum Menikah' : $app->user->status_pernikahan == 'menikah') ? 'Menikah' : 'Duda' }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Agama</th>
                                                                            <td>:</td>
                                                                            <td>{{ $app->user->agama }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Alamat</th>
                                                                            <td>:</td>
                                                                            <td>{{ $app->user->alamat }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Provinsi</th>
                                                                            <td>:</td>
                                                                            <td>{{ $app->user->provinsi }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Kota</th>
                                                                            <td>:</td>
                                                                            <td>{{ $app->user->kota }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">No Hp</th>
                                                                            <td>:</td>
                                                                            <td>{{ $app->user->no_hp }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Pendidikan Terakhir</th>
                                                                            <td>:</td>
                                                                            <td>{{ $app->user->pendidikan_terakhir }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Jurusan</th>
                                                                            <td>:</td>
                                                                            <td>{{ $app->user->jurusan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Lampiran Ijazah</th>
                                                                            <td>:</td>
                                                                            <td><a href="{{ Storage::url($app->user->lampiran_ijazah) }}"
                                                                                    target="blank"><i
                                                                                        class="bi bi-file-earmark-text-fill"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Lampiran CV</th>
                                                                            <td>:</td>
                                                                            <td><a href="{{ Storage::url($app->user->lampiran_cv) }}"
                                                                                    target="blank"><i
                                                                                        class="bi bi-file-earmark-text-fill"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Lampiran KTP</th>
                                                                            <td>:</td>
                                                                            <td><a href="{{ Storage::url($app->user->lampiran_ktp) }}"
                                                                                    target="blank"><i
                                                                                        class="bi bi-file-earmark-text-fill"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Lampiran Keterangan Sehat
                                                                            </th>
                                                                            <td>:</td>
                                                                            <td><a href="{{ Storage::url($app->user->lampiran_keterangan_sehat) }}"
                                                                                    target="blank"><i
                                                                                        class="bi bi-file-earmark-text-fill"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Lampiran Keterangan SKCK
                                                                            </th>
                                                                            <td>:</td>
                                                                            <td><a href="{{ Storage::url($app->user->lampiran_skck) }}"
                                                                                    target="blank"><i
                                                                                        class="bi bi-file-earmark-text-fill"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Status</th>
                                                                            <td>:</td>
                                                                            <td>{{ $app->user->status }}
                                                                            </td>
                                                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                </x-modal>


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

        <script>
            $(document).ready(function() {

                // $('[data-toggle="tooltip"]').tooltip()
                $('.datatable').DataTable({
                    dom: 'Bfrtip', // Mengaktifkan tombol export
                    buttons: [{
                            extend: 'excelHtml5',
                            title: 'Data Pelamar',
                        },
                        {
                            extend: 'csvHtml5',
                            title: 'Data Pelamar',
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Pelamar',
                            orientation: 'portrait',
                            pageSize: 'A4',
                        },
                        {
                            extend: 'print',
                            title: 'Data Pelamar',
                        }
                    ]
                });

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
