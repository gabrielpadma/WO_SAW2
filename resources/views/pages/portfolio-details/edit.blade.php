<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Detail Portfolio</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('portfolio.index') }}">Portfolio</a> </li>
                    <li class="breadcrumb-item">{{ $portfolio->id }}</li>
                    <li class="breadcrumb-item">Detail Portfolio</li>
                    <li class="breadcrumb-item active">{{ $portfolio_detail->id }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Detail Portfolio</h5>
                            <form
                                action="{{ route('portfolio.portfolio-detail.update', ['portfolio' => $portfolio->id, 'portfolio_detail' => $portfolio_detail->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="detail_image1" class="form-label">Gambar 1</label>
                                            <input @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('detail_image1'),
                                            ]) type="file" id="detail_image1"
                                                name="detail_image1">

                                            @php
                                                if ($portfolio_detail?->detail_image1) {
                                                    $fileName = $portfolio_detail->detail_image1
                                                        ? basename($portfolio_detail->detail_image1)
                                                        : 'Tidak ada file';
                                                }
                                            @endphp

                                            @if ($portfolio_detail?->detail_image1 ?? false)
                                                <p>File yang sudah diunggah: <a
                                                        href="{{ asset('storage/' . $portfolio_detail->detail_image1) }}"
                                                        target="_blank">{{ $fileName }}</a></p>
                                            @else
                                                <p class="text-sm text-danger">* Tidak ada file yang diunggah.</p>
                                            @endif

                                            @error('detail_image1')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="detail_image2" class="form-label">Gambar 2</label>
                                            <input @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('detail_image2'),
                                            ]) type="file" id="detail_image2"
                                                name="detail_image2">

                                            @php
                                                if ($portfolio_detail?->detail_image2) {
                                                    $fileName = $portfolio_detail->detail_image2
                                                        ? basename($portfolio_detail->detail_image2)
                                                        : 'Tidak ada file';
                                                }
                                            @endphp

                                            @if ($portfolio_detail?->detail_image2 ?? false)
                                                <p>File yang sudah diunggah: <a
                                                        href="{{ asset('storage/' . $portfolio_detail->detail_image2) }}"
                                                        target="_blank">{{ $fileName }}</a></p>
                                            @else
                                                <p class="text-sm text-danger">* Tidak ada file yang diunggah.</p>
                                            @endif

                                            @error('detail_image2')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="detail_image3" class="form-label">Gambar 3</label>
                                            <input @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('detail_image3'),
                                            ]) type="file" id="detail_image3"
                                                name="detail_image3">

                                            @php
                                                if ($portfolio_detail?->detail_image3) {
                                                    $fileName = $portfolio_detail->detail_image3
                                                        ? basename($portfolio_detail->detail_image3)
                                                        : 'Tidak ada file';
                                                }
                                            @endphp

                                            @if ($portfolio_detail?->detail_image3 ?? false)
                                                <p>File yang sudah diunggah: <a
                                                        href="{{ asset('storage/' . $portfolio_detail->detail_image3) }}"
                                                        target="_blank">{{ $fileName }}</a></p>
                                            @else
                                                <p class="text-sm text-danger">* Tidak ada file yang diunggah.</p>
                                            @endif

                                            @error('image_path3')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="detail_image4" class="form-label">Gambar 4</label>
                                            <input @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('detail_image4'),
                                            ]) type="file" id="detail_image4"
                                                name="detail_image4">

                                            @php
                                                if ($portfolio_detail?->detail_image4) {
                                                    $fileName = $portfolio_detail->detail_image4
                                                        ? basename($portfolio_detail->detail_image4)
                                                        : 'Tidak ada file';
                                                }
                                            @endphp

                                            @if ($portfolio_detail?->detail_image4 ?? false)
                                                <p>File yang sudah diunggah: <a
                                                        href="{{ asset('storage/' . $portfolio_detail->detail_image4) }}"
                                                        target="_blank">{{ $fileName }}</a></p>
                                            @else
                                                <p class="text-sm text-danger">* Tidak ada file yang diunggah.</p>
                                            @endif

                                            @error('image_path4')
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



    </main>
</x-admin.layout.layout>
