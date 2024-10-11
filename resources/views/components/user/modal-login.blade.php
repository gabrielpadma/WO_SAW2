<div class="modal-wrapper">
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex gap-2">
                    <img src="{{ url('assets/img/login-img.jpg') }}" class="img-fluid d-none d-md-block"
                        style="object-position:center center;border-radius: 5px 0 0 5px;
                        width:40%;
                        "
                        alt="...">
                    <div class="isi-modal w-100">
                        <div class="modal-body d-flex flex-column gap-3">
                            <h4 class="text-dark">Selamat datang</h4>
                            <form action='/login' method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label small">Email address</label>
                                    <input type="email" name="email" @class(['form-control ', 'is-invalid' => $errors->has('email')]) id="email"
                                        aria-describedby="emailHelp">
                                    @error('email')
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label small">Password</label>
                                    <input type="password" name="password" @class(['form-control ', 'is-invalid' => $errors->has('password')]) id="password">
                                    @error('password')
                                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Login</button>
                                <div id="emailHelp" class="form-text mt-3 small text-secondary">Belum punya akun ? <a
                                        href="{{ route('user.index') }}">Daftar
                                        Akun</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($errors->has('email') || $errors->has('password'))
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('loginModal'));
        myModal.show();
    </script>
    @dd($errors->any())
@endif
