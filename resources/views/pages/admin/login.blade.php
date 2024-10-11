<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f4f6f9;
        }

        .login-container {
            max-width: 900px;
            margin: 5rem auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        .login-image {
            background-color: #f8f9fa;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            padding: 2rem;
        }

        .login-image img {
            max-width: 100%;
            height: auto;
        }

        .login-form {
            flex: 1;
            padding: 2rem;
        }

        .login-form h2 {
            margin-bottom: 1rem;
        }

        .social-login {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .social-login button {
            width: 48%;
        }

        .remember-me {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Image Section -->
        <div class="login-image">
            <img src="{{ url('assets/img/login_img.webp') }}" alt="Login Illustration" />
        </div>

        <!-- Right Form Section -->
        <div class="login-form">
            <h2 class="text-success">Welcome to Alucio</h2>
            <p>Your Admin Dashboard</p>

            <!-- Login Form -->
            <form action="{{ route('loginAdmin') }}" method="POST">
                @csrf
                @method('post')
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" @class(['form-control ', 'is-invalid' => $errors->has('email')]) name="email" id="email" required
                        placeholder="Masukan Email Anda" />
                    @error('email')
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" @class(['form-control ', 'is-invalid' => $errors->has('password')]) name="password" id="password" required
                        placeholder="Masukan Password Anda" />
                    @error('password')
                        <div id="validationServerPasswordFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="remember-me form-check">
                    <input type="checkbox" class="form-check-input" id="rememberDevice" />
                    <label class="form-check-label text-muted fs-6" for="rememberDevice">Remember this device</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign In</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



    @if (session()->has('login'))
        <script>
            Swal.fire({
                icon: '{{ session('login')['icon'] }}',
                title: '{{ session('login')['title'] }}',
                text: '{{ session('login')['message'] }}',
            });
        </script>
    @endif
    @if (session()->has('swal'))
        <script>
            Swal.fire({
                icon: '{{ session('swal')['icon'] }}',
                title: '{{ session('swal')['title'] }}',
                text: '{{ session('swal')['message'] }}',
            });
        </script>
    @endif


</body>

</html>
