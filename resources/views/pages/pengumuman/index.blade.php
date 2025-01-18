<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Pengaturan Pengumuman ke Pelamar</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Pengumuman</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white fw-bold">
                            Pengumuman ke Pelamar
                        </div>
                        <div class="card-body">
                            <p class="text-dark fw-bold mt-2">Terakhir Update : {{ $Pengumuman?->updated_at ?? '-' }}
                            </p>
                            <form method="post" enctype="multipart/form-data" class="mt-3">
                                @csrf
                                <div class="row mb-3">
                                    <textarea id="desc_pengumuman" name="desc_pengumuman" required>
                                    {{ old('desc_pengumuman', $Pengumuman?->desc_pengumuman ?? '') }}
                                </textarea>
                                    @error('desc_pengumuman')
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
                    </div>
                </div>
            </div>
        </section>


        <script>
            $(function() {
                tinymce.init({
                    selector: '#desc_pengumuman',
                    height: 200,
                    plugins: 'lists link image code',
                    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
                    menubar: false,

                });
            });
        </script>

    </main>
</x-admin.layout.layout>
