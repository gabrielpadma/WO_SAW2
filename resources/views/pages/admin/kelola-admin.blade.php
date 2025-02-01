<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kelola Admin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Kelola Admin</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        @if (Auth::user()->role == 'superadmin')
            <button type="button" class="btn btn-primary btn-icon-split ms-2 mb-3" data-bs-toggle="modal"
                data-bs-target="#modalTambahData">
                <i class="bi bi-plus-lg"></i>
                <span>
                    Tambah Admin
                </span>
            </button>
        @endif

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Admin</h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Tanggal Buat</th>
                                        @if (Auth::user()->role == 'superadmin')
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allAdmin as $admin)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->created_at->format('d-m-Y H:i') }}</td>
                                            @if (Auth::user()->role == 'superadmin')
                                                <td class="d-flex gap-1">
                                                    <a href="{{ route('edit-admin', ['admin' => $admin->id]) }}"
                                                        class="btn btn-primary btn-circle"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    <form action="{{ route('hapus-admin', ['admin' => $admin->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-danger btn-circle btn-hapus">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
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

        <x-modal title="Tambah Data Admin" idModal="modalTambahData">
            <form action="{{ route('simpan-admin') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>

                    <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('name')]) id="name" name="name"
                        aria-describedby="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>

                    <input type="password" @class(['form-control ', 'is-invalid' => $errors->has('password')]) id="password" name="password"
                        aria-describedby="password" value="{{ old('password') }}" required>
                    @error('password')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('email')]) id="email" name="email"
                        aria-describedby="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div id="email" class="invalid-feedback">
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
                            title: 'Data Lowongan',
                        },
                        {
                            extend: 'csvHtml5',
                            title: 'Data Lowongan',
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Lowongan',
                            orientation: 'portrait',
                            pageSize: 'A4',
                        },
                        {
                            extend: 'print',
                            title: 'Data Lowongan',
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

            });
        </script>

    </main>
</x-admin.layout.layout>
