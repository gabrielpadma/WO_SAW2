<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Hero Content</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Hero Content</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-12">
                    @php
                        $errorsHeroSection = collect($errors->keys())->contains(function ($key) {
                            return str_starts_with($key, 'welcome_text') ||
                                str_starts_with($key, 'content_text') ||
                                str_starts_with($key, 'image_path1') ||
                                str_starts_with($key, 'image_path2') ||
                                str_starts_with($key, 'image_path3') ||
                                str_starts_with($key, 'image_path4') ||
                                str_starts_with($key, 'image_path5');
                        });

                        $errorsTabPaneAbout = collect($errors->keys())->contains(function ($key) {
                            return str_starts_with($key, 'mission') ||
                                str_starts_with($key, 'mission_title') ||
                                str_starts_with($key, 'mission_desc') ||
                                str_starts_with($key, 'mission_image') ||
                                str_starts_with($key, 'why_us_title') ||
                                str_starts_with($key, 'why_us_desc') ||
                                str_starts_with($key, 'why_us_image') ||
                                str_starts_with($key, 'total_project') ||
                                str_starts_with($key, 'total_vendor') ||
                                str_starts_with($key, 'team_members');
                        });

                        $defaultTab = !$errorsHeroSection && !$errorsTabPaneAbout;
                    @endphp
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered ">

                                <li class="nav-item">
                                    <button @class(['nav-link', 'active' => $defaultTab]) data-bs-toggle="tab"
                                        data-bs-target="#hero-section">Hero Section</button>
                                </li>

                                <li class="nav-item">
                                    <button @class(['nav-link', 'active' => $errorsTabPaneAbout]) data-bs-toggle="tab"
                                        data-bs-target="#about-us">
                                        About Us</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#layanan">Layanan</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#testimonial">Testimonial</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div @class([
                                    'tab-pane',
                                    'fade',
                                    'hero-section',
                                    'show' => $defaultTab,
                                    'active' => $defaultTab,
                                ]) id="hero-section">
                                    <h5 class="card-title">Setting Hero Section</h5>
                                    <form method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="currentPassword"
                                                class="col-md-4 col-lg-3 col-form-label">Welcome Text</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="welcome_text" type="text" class="form-control"
                                                    id="welcome_text"
                                                    value=" {{ old('welcome_text', $HeroContent->welcome_text ?? '') }}">
                                                @error('welcome_text')
                                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="content_text" class="col-md-4 col-lg-3 col-form-label">Text
                                                Content</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea id="content_text" name="content_text" required>
                                                {{ old('content_text', $HeroContent->content_text ?? '') }}
                                            </textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="image_path1" class="form-label">Gambar Hero 1</label>
                                            <input @class(['form-control ', 'is-invalid' => $errors->has('image_path1')]) type="file" id="image_path1"
                                                name="image_path1">

                                            @php
                                                if ($HeroContent?->image_path1) {
                                                    $fileName = $HeroContent->image_path1
                                                        ? basename($HeroContent->image_path1)
                                                        : 'Tidak ada file';
                                                }
                                            @endphp

                                            @if ($HeroContent?->image_path1 ?? false)
                                                <p>File yang sudah diunggah: <a
                                                        href="{{ asset('storage/' . $HeroContent->image_path1) }}"
                                                        target="_blank">{{ $fileName }}</a></p>
                                            @else
                                                <p class="text-sm text-danger">* Tidak ada file yang diunggah.</p>
                                            @endif

                                            @error('image_path1')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row mb-3">
                                            <label for="image_path2" class="form-label">Gambar Hero 2</label>
                                            <input @class(['form-control ', 'is-invalid' => $errors->has('image_path2')]) type="file" id="image_path2"
                                                name="image_path2">

                                            @php
                                                if ($HeroContent?->image_path2) {
                                                    $fileName = $HeroContent->image_path2
                                                        ? basename($HeroContent->image_path2)
                                                        : 'Tidak ada file';
                                                }
                                            @endphp
                                            @if ($HeroContent?->image_path2 ?? false)
                                                <p>File yang sudah diunggah: <a
                                                        href="{{ asset('storage/' . $HeroContent->image_path2) }}"
                                                        target="_blank">{{ $fileName }}</a></p>
                                            @else
                                                <p class="text-sm text-danger">* Tidak ada file yang diunggah.</p>
                                            @endif


                                            @error('image_path2')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row mb-3">
                                            <label for="image_path3" class="form-label">Gambar Hero 3</label>
                                            <input @class(['form-control ', 'is-invalid' => $errors->has('image_path3')]) type="file" id="image_path3"
                                                name="image_path3">

                                            @php
                                                if ($HeroContent?->image_path3) {
                                                    $fileName = $HeroContent->image_path3
                                                        ? basename($HeroContent->image_path3)
                                                        : 'Tidak ada file';
                                                }
                                            @endphp

                                            @if ($HeroContent?->image_path3 ?? false)
                                                <p>File yang sudah diunggah: <a
                                                        href="{{ asset('storage/' . $HeroContent->image_path3) }}"
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
                                        <div class="row mb-3">
                                            <label for="image_path4" class="form-label">Gambar Hero 4</label>
                                            <input @class(['form-control ', 'is-invalid' => $errors->has('image_path4')]) type="file" id="image_path4"
                                                name="image_path4">


                                            @php
                                                if ($HeroContent?->image_path4) {
                                                    $fileName = $HeroContent->image_path4
                                                        ? basename($HeroContent->image_path4)
                                                        : 'Tidak ada file';
                                                }
                                            @endphp

                                            @if ($HeroContent?->image_path4 ?? false)
                                                <p>File yang sudah diunggah: <a
                                                        href="{{ asset('storage/' . $HeroContent->image_path4) }}"
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
                                        <div class="row mb-3">
                                            <label for="image_path5" class="form-label">Gambar Hero 5</label>
                                            <input @class(['form-control ', 'is-invalid' => $errors->has('image_path5')]) type="file" id="image_path5"
                                                name="image_path5">

                                            @php
                                                if ($HeroContent?->image_path5) {
                                                    $fileName = $HeroContent->image_path5
                                                        ? basename($HeroContent->image_path5)
                                                        : 'Tidak ada file';
                                                }
                                            @endphp

                                            @if ($HeroContent?->image_path5 ?? false)
                                                <p>File yang sudah diunggah: <a
                                                        href="{{ asset('storage/' . $HeroContent->image_path5) }}"
                                                        target="_blank">{{ $fileName }}</a></p>
                                            @else
                                                <p class="text-sm text-danger">* Tidak ada file yang diunggah.</p>
                                            @endif
                                            @error('image_path5')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                                        </div>
                                    </form>

                                </div>
                                <div @class([
                                    'tab-pane',
                                    'fade',
                                    'hero-section',
                                    'pt-3',
                                    'show' => $errorsTabPaneAbout,
                                    'active' => $errorsTabPaneAbout,
                                ]) id="about-us">
                                    <h5 class="card-title">Setting About Us</h5>
                                    <form method="post" action="{{ route('about-us.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="mission" class="col-md-4 col-lg-3 col-form-label">Misi
                                                Kami</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="mission" type="text" class="form-control"
                                                    id="mission" value="{{ old('mission', $AboutUs?->mission) }}">
                                            </div>
                                            @error('mission')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row mb-3">
                                            <label for="mission_title" class="col-md-4 col-lg-3 col-form-label">Judul
                                                Misi
                                                Kami</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="mission_title" type="text" class="form-control"
                                                    id="mission_title"
                                                    value="{{ old('mission_title', $AboutUs?->mission_title) }}">
                                            </div>
                                            @error('mission_title')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label for="mission_desc"
                                                class="col-md-4 col-lg-3 col-form-label">Deskripsi Misi</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="mission_desc" class="form-control" id="mission_desc" style="height: 100px">{{ old('mission_desc', $AboutUs?->mission_desc) }}</textarea>
                                            </div>
                                            @error('mission_desc')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="row mb-3">
                                            <label for="mission_image" class="form-label">Gambar Misi</label>
                                            <input @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('mission_image'),
                                            ]) type="file" id="mission_image"
                                                name="mission_image">

                                            @php
                                                if ($AboutUs?->mission_image) {
                                                    $fileName = $AboutUs->mission_image
                                                        ? basename($AboutUs->mission_image)
                                                        : 'Tidak ada file';
                                                }
                                            @endphp

                                            @if ($AboutUs?->mission_image ?? false)
                                                <p>File yang sudah diunggah: <a
                                                        href="{{ asset('storage/' . $AboutUs->mission_image) }}"
                                                        target="_blank">{{ $fileName }}</a></p>
                                            @else
                                                <p class="text-sm text-danger">* Tidak ada file yang diunggah.</p>
                                            @endif

                                            @error('mission_image')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="row mb-3">
                                            <label for="why_us_title" class="col-md-4 col-lg-3 col-form-label">Why
                                                Us</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="why_us_title" type="text" class="form-control"
                                                    id="why_us_title"
                                                    value="{{ old('why_us_title', $AboutUs?->why_us_title) }}">
                                            </div>
                                            @error('why_us_title')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label for="why_us_desc"
                                                class="col-md-4 col-lg-3 col-form-label">Deskripsi Why Us</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="why_us_desc" class="form-control" id="why_us_desc" style="height: 100px">{{ old('why_us_desc', $AboutUs?->why_us_desc) }}</textarea>
                                            </div>
                                            @error('why_us_desc')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label for="why_us_image" class="form-label">Gambar Why Us</label>
                                            <input @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('why_us_image', $AboutUs?->why_us_image),
                                            ]) type="file" id="why_us_image"
                                                name="why_us_image">

                                            @php
                                                if ($AboutUs?->why_us_image) {
                                                    $fileName = $AboutUs->why_us_image
                                                        ? basename($AboutUs->why_us_image)
                                                        : 'Tidak ada file';
                                                }
                                            @endphp

                                            @if ($AboutUs?->why_us_image ?? false)
                                                <p>File yang sudah diunggah: <a
                                                        href="{{ asset('storage/' . $AboutUs->why_us_image) }}"
                                                        target="_blank">{{ $fileName }}</a></p>
                                            @else
                                                <p class="text-sm text-danger">* Tidak ada file yang diunggah.</p>
                                            @endif

                                            @error('why_us_image')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="row mb-3">
                                            <label for="total_project" class="col-md-4 col-lg-3 col-form-label">Total
                                                Project</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="total_project" type="number" class="form-control"
                                                    id="total_project"
                                                    value="{{ old('total_project', $AboutUs?->total_project) }}">
                                            </div>
                                            @error('total_project')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row mb-3">
                                            <label for="total_vendor" class="col-md-4 col-lg-3 col-form-label">Total
                                                Vendor</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="total_vendor" type="number" class="form-control"
                                                    id="total_vendor"
                                                    value="{{ old('total_vendor', $AboutUs?->total_vendor) }}">
                                            </div>
                                            @error('total_vendor')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row mb-3">
                                            <label for="team_members" class="col-md-4 col-lg-3 col-form-label">Total
                                                Team Members</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="team_members" type="number" class="form-control"
                                                    id="team_members"
                                                    value="{{ old('team_members', $AboutUs?->team_members) }}">
                                            </div>
                                            @error('team_members')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>
                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if ($errors->any())
            <script>
                const myModal = new bootstrap.Modal(document.getElementById('modalTambahData'));
                myModal.show();
            </script>
        @endif


        <script>
            $(document).ready(function() {

                tinymce.init({
                    selector: '#content_text',
                    height: 200,
                    plugins: 'lists link image code',
                    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
                    menubar: false,

                });
                tinymce.init({
                    selector: '#mission_desc',
                    height: 200,
                    plugins: 'lists link image code',
                    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
                    menubar: false,

                });
                tinymce.init({
                    selector: '#why_us_desc',
                    height: 200,
                    plugins: 'lists link image code',
                    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
                    menubar: false,

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
