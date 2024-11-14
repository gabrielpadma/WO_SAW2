<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Data Paket Wedding</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"> <a href="{{ route('wedding-package.index') }}">Paket Wedding</a> </li>
                    <li class="breadcrumb-item">{{ $wedding_package->id }}</li>
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Paket Wedding</h5>
                            <form
                                action="{{ route('wedding-package.update', ['wedding_package' => $wedding_package->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="package_title" class="form-label">Judul Paket</label>
                                            <input type="text" @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('package_title'),
                                            ]) id="package_title"
                                                name="package_title" aria-describedby="judulPaket" required
                                                value="{{ old('package_title', $wedding_package->package_title) }}">
                                            @error('package_title')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group mb-6">
                                            <label for="features" class="form-label">Fitur</label>
                                            <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('features')]) id="features"
                                                name="features" aria-describedby="features" required
                                                value="{{ old('features', $wedding_package->features) }}"
                                                placeholder="Pisahkan dengan tanda ','">
                                            @error('features')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group mb-3">
                                            <label for="price" class="form-label">Harga</label>
                                            <input type="text" @class(['form-control ', 'is-invalid' => $errors->has('price')]) id="price"
                                                name="price" aria-describedby="price" required
                                                value="{{ old('price', $wedding_package->price) }}">
                                            @error('price')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group mb-3">
                                            <label for="is_active" class="form-label">Status</label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="is_active">
                                                <option value="">-- Pilih Status --</option>
                                                <option value="1"
                                                    {{ old('is_active', $wedding_package->is_active) == '1' ? 'selected' : '' }}>
                                                    Aktif</option>
                                                <option value="0"
                                                    {{ old('is_active', $wedding_package->is_active) == '0' ? 'selected' : '' }}>
                                                    Non Aktif</option>
                                            </select>
                                            @error('is_active')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group mb-3">
                                            <label for="is_recommed" class="form-label">Rekomendasi</label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="is_recommend">
                                                <option value="">-- Jadikan Rekomendasi --</option>
                                                <option value="1"
                                                    {{ old('is_recommend', $wedding_package->is_recommend) == '1' ? 'selected' : '' }}>
                                                    Ya</option>
                                                <option value="0"
                                                    {{ old('is_recommend', $wedding_package->is_recommend) == '0' ? 'selected' : '' }}>
                                                    Tidak</option>
                                            </select>
                                            @error('is_recommend')
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

                $('#price').on('keyup', function(e) {
                    let value = $(this).val().replace(/[^,\d]/g, '');
                    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    $(this).val(value);
                });

            });
        </script>

    </main>
</x-admin.layout.layout>
