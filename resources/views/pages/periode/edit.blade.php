<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Periode</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"> <a href="{{ route('vacancy.index') }}">Lowongan</a> </li>
                    <li class="breadcrumb-item">{{ $periode->vacancy->id }}</li>
                    <li class="breadcrumb-item"> <a
                            href="{{ route('vacancy.show', ['vacancy' => $periode->vacancy->id]) }}">Periode</a> </li>
                    <li class="breadcrumb-item">{{ $periode->id }}</li>
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Periode</h5>
                            <form action="{{ route('proses-edit', ['periode' => $periode->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $periode->vacancy->id }}" name="vacancy_id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <input type="month" @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('tanggal_periode'),
                                            ]) id="tanggal_periode"
                                                name="tanggal_periode" aria-describedby="judulLowongan" required
                                                value="{{ old('tanggal_periode', $periode->tanggal_periode) }}">
                                            @error('tanggal_periode')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group mb-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="status">
                                                <option value="">--Pilih Status--</option>
                                                <option value="0" {{ $periode->status == '0' ? 'selected' : '' }}>
                                                    Non
                                                    Aktif</option>
                                                <option value="1" {{ $periode->status == '1' ? 'selected' : '' }}>
                                                    Aktif
                                                </option>
                                            </select>

                                            @error('status')
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
            });
        </script>

    </main>
</x-admin.layout.layout>
