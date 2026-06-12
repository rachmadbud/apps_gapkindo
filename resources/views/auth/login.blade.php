@extends('auth.app')

@section('content')
    @php
        use App\Models\CustomClass;
    @endphp

    <style>
        #eye-icon {
            cursor: pointer;
        }

        /* FORCE CENTER: Memaksa halaman login berada tepat di tengah layar */
        html,
        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        body.login-page {
            background: linear-gradient(135deg, #f1f5f9 0%, #cbd5e1 100%) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-height: 100vh !important;
            font-family: 'Poppins', 'Inter', sans-serif !important;
        }

        .login-center-wrapper {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            padding: 20px !important;
            box-sizing: border-box !important;
        }

        /* KOTAK LOGIN DENGAN BINGKAI HIJAU GAPKINDO */
        .custom-login-container {
            display: flex;
            width: 850px;
            max-width: 100%;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            /* Bingkai Hijau Gapkindo */
            border: 2.5px solid #1e4620 !important;
            /* Efek Glow & Shadow Lembut */
            box-shadow: 0 15px 40px rgba(30, 70, 32, 0.15) !important;
        }

        /* Kolom Kiri: Form Login */
        .login-side-form {
            flex: 1.1;
            padding: 3.5rem 3rem !important;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Kolom Kanan: Panel Info Dark */
        .login-side-visual {
            flex: 0.9;
            background: linear-gradient(135deg, #232d37 0%, #161c22 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem 2rem;
            color: #ffffff;
            text-align: center;
        }

        @media (max-width: 768px) {
            .login-side-visual {
                display: none !important;
            }

            .custom-login-container {
                width: 420px;
            }

            .login-side-form {
                padding: 2.5rem 2rem !important;
            }
        }

        /* Desain Kolom Input Modern */
        .custom-login-container .input-group {
            margin-bottom: 1.25rem !important;
        }

        .custom-login-container .form-control {
            border-radius: 0 8px 8px 0 !important;
            background-color: #f8fafc !important;
            border: 1px solid #cbd5e1 !important;
            border-left: none !important;
            padding: 1.4rem 1rem !important;
            font-size: 14px !important;
            height: 46px !important;
            transition: all 0.2s ease;
        }

        .custom-login-container .form-control:focus {
            border-color: #94a3b8 !important;
            /* Focus berubah ke hijau gapkindo */
            background-color: #ffffff !important;
            box-shadow: none !important;
        }

        .custom-login-container .input-group-prepend .input-group-text {
            background-color: #f8fafc !important;
            border-color: #cbd5e1 !important;
            border-top-left-radius: 8px !important;
            border-bottom-left-radius: 8px !important;
            color: #94a3b8 !important;
            min-width: 46px;
            justify-content: center;
        }

        .custom-login-container .input-group-append .input-group-text {
            background-color: #f8fafc !important;
            border-color: #cbd5e1 !important;
            border-top-right-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
            color: #94a3b8 !important;
        }

        /* Tombol Sign In Premium */
        .custom-login-container .btn-primary {
            background: linear-gradient(135deg, #4eac52 0%, #437746 100%) !important;
            /* Tombol warna senada */
            border: none !important;
            border-radius: 8px !important;
            padding: 0.75rem 1rem !important;
            font-weight: 600 !important;
            font-size: 15px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(30, 70, 32, 0.2) !important;
            height: 46px;
        }

        .custom-login-container .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(30, 70, 32, 0.35) !important;
        }

        .svg-illustration {
            width: 180px;
            height: 180px;
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }
    </style>

    <div class="login-center-wrapper">
        <div class="custom-login-container">

            <div class="login-side-form">
                <div class="text-center mb-4">
                    <img src="{{ asset('') }}logo-gapkindo.gif" width="60px" alt="Logo Gapkindo">
                    <h2 class="mt-3 font-weight-bold text-dark" style="font-size: 1.5rem; letter-spacing: -0.5px;">Apps
                        Gapkindo</h2>
                    <p class="text-muted text-sm">Silakan masuk untuk mengelola arsip.</p>
                </div>

                @if (session()->has('loginError') || session()->has('loginIPNyangkut'))
                    <div class='alert alert-danger text-sm p-3 mb-3 text-center'
                        style="border-radius: 8px; border: none; background-color: #fef2f2; color: #991b1b;">
                        @if (session('loginError') < config('secure.APP_SEKURITI_FAIL_LOGIN') && session('loginIPNyangkut') != 1)
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ app(CustomClass::class)->notifGagalLogin() }}
                        @elseif(session('loginIPNyangkut') == 1)
                            <i class="fas fa-network-wired mr-1"></i>
                            {{ app(CustomClass::class)->notifIPNyangkut() . ' (IP : ' . session('ipEksisting') . ')' }}
                        @else
                            <i class="fas fa-ban mr-1"></i> {{ app(CustomClass::class)->notifBlokirLogin() }}
                        @endif
                    </div>
                @endif

                <form method="post" action="{{ route('login.custom') }}">
                    @csrf

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                        </div>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="" placeholder="User Name" required autofocus>
                        @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-key"></i></div>
                        </div>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            value="" id="passwordInput" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span id="eye-icon" onclick="togglePasswordVisibility()" class="fas fa-eye"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In <i
                                    class="fas fa-sign-in-alt ml-1"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="login-side-visual">
                <svg class="svg-illustration" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19 4H5C3.89543 4 3 4.89543 3 6V18C3 19.1046 3.89543 20 5 20H19C20.1046 20 21 19.1046 21 18V6C21 4.89543 20.1046 4 19 4Z"
                        stroke="#38bdf8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M3 6L12 13L21 6" stroke="#38bdf8" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <circle cx="18" cy="14" r="4" fill="#0ea5e9" />
                    <path d="M16.5 14L17.5 15L19.5 13" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

                <div class="px-3">
                    <h5 class="font-weight-bold text-white mb-2" style="letter-spacing: 0.5px;">Manajemen Digital</h5>
                    <p class="text-white-50 text-xs mb-0" style="line-height: 1.6; opacity: 0.7;">Pengarsipan,
                        dan pelacakan surat masuk dan keluar dalam satu sistem terintegrasi.</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('passwordInput');
            var eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
