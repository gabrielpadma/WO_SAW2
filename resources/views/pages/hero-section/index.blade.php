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
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                            <h2>Kevin Anderson</h2>
                            <h3>Web Designer</h3>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered ">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#hero-section">Hero Section</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#siapa-kami">
                                        Siapa Kami</button>
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
                                <div class="tab-pane fade show active hero-section" id="hero-section">
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

                                <div class="tab-pane fade siapa-kami pt-3" id="siapa-kami">

                                    <!-- Profile Edit Form -->
                                    <form>
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="assets/img/profile-img.jpg" alt="Profile">
                                                <div class="pt-2">
                                                    <a href="#" class="btn btn-primary btn-sm"
                                                        title="Upload new profile image"><i
                                                            class="bi bi-upload"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"
                                                        title="Remove my profile image"><i
                                                            class="bi bi-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fullName" type="text" class="form-control"
                                                    id="fullName" value="Kevin Anderson">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="about"
                                                class="col-md-4 col-lg-3 col-form-label">About</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="about" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="company"
                                                class="col-md-4 col-lg-3 col-form-label">Company</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="company" type="text" class="form-control"
                                                    id="company" value="Lueilwitz, Wisoky and Leuschke">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="job" type="text" class="form-control"
                                                    id="Job" value="Web Designer">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Country"
                                                class="col-md-4 col-lg-3 col-form-label">Country</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="country" type="text" class="form-control"
                                                    id="Country" value="USA">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address"
                                                class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control"
                                                    id="Address" value="A108 Adam Street, New York, NY 535022">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone"
                                                class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control"
                                                    id="Phone" value="(436) 486-3538 x29071">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email"
                                                class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control"
                                                    id="Email" value="k.anderson@example.com">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="twitter" type="text" class="form-control"
                                                    id="Twitter" value="https://twitter.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook" type="text" class="form-control"
                                                    id="Facebook" value="https://facebook.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram" type="text" class="form-control"
                                                    id="Instagram" value="https://instagram.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="linkedin" type="text" class="form-control"
                                                    id="Linkedin" value="https://linkedin.com/#">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="layanan">

                                    <!-- Settings Form -->
                                    <form>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                                Notifications</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="changesMade"
                                                        checked>
                                                    <label class="form-check-label" for="changesMade">
                                                        Changes made to your account
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="newProducts"
                                                        checked>
                                                    <label class="form-check-label" for="newProducts">
                                                        Information on new products and services
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="proOffers">
                                                    <label class="form-check-label" for="proOffers">
                                                        Marketing and promo offers
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="securityNotify" checked disabled>
                                                    <label class="form-check-label" for="securityNotify">
                                                        Security alerts
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End settings Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="testimonial">

                                    <form>

                                        <div class="row mb-3">
                                            <label for="currentPassword"
                                                class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                    id="currentPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="password" class="form-control"
                                                    id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword"
                                                class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" type="password" class="form-control"
                                                    id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form>

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
