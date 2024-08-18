<div class="modal-wrapper">
    <div class="modal fade" wire:ignore.self id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                            <form wire:submit="login">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label small">Email address</label>
                                    <input type="email" @class(['form-control ', 'is-invalid' => $errors->has('email')]) id="exampleInputEmail1"
                                        wire:model="email" aria-describedby="emailHelp">
                                    @error('password')
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label small">Password</label>
                                    <input type="password" @class(['form-control ', 'is-invalid' => $errors->has('password')]) id="exampleInputPassword1"
                                        wire:model="password">
                                    @error('password')
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Login</button>
                                <div id="emailHelp" class="form-text mt-3 small text-secondary">Belum punya akun ? <a
                                        href="#">Daftar
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
