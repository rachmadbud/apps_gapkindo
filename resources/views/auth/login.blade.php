@extends('auth.app')
@section('content')
    @push('style')
        <style>
            #eye-icon {
                cursor: pointer;
            }
        </style>
    @endpush

    @php
        use App\Models\CustomClass;
    @endphp

    <br>

    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- <div class="login-logo">
                                                                                                                                                                                                                                                                                                                                                                    <b>{{ config('app.name') }}</b>
                                                                                                                                                                                                                                                                                                                                                                </div> -->

            <div class="card card-outline card-dark">
                <div class="card-header text-center">
                    <img src="{{ asset('') }}assets/images/logoIconBwwy.gif" width="43px" alt="">
                    <h2>{{ config('app.name') }}</h2>
                </div>

                <!-- /.login-box-body -->
                <!-- <div class="card"> -->
                <div class="card-body login-card-body">
                    <!-- <p class="login-box-msg">Sign in to start your session</p> -->

                    @if (session()->has('loginError') || session()->has('loginIPNyangkut'))
                        <p class="login-box-msg">
                        <div class='login-box-msg alert alert-danger alert-dismissible' align='center'>
                            @if (session('loginError') < config('secure.APP_SEKURITI_FAIL_LOGIN') && session('loginIPNyangkut') != 1)
                                {{ app(CustomClass::class)->notifGagalLogin() }}
                            @elseif(session('loginIPNyangkut') == 1)
                                {{ app(CustomClass::class)->notifIPNyangkut() . ' (IP Address : ' . session('ipEksisting') . ')' }}
                            @else
                                {{ app(CustomClass::class)->notifBlokirLogin() }}
                            @endif
                        </div>
                        </p>
                    @endif

                    <form method="post" action="{{ route('login.custom') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                            </div>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="" placeholder="User Name">
                            @error('name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-solid fa-key"></i></div>
                            </div>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" value=""
                                id="passwordInput" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span id="eye-icon" onclick="togglePasswordVisibility()" class="fas fa-eye"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="row">
                            <div class="col-8">
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>

                        </div>
                    </form>

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



    {{-- @extends('auth.app')
@section('content')

@php
use App\Models\CustomClass;
@endphp

<br>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- <div class="login-logo">
        <b>{{ config('app.name') }}</b>
    </div> -->

    <div class="card card-outline card-dark">
        <div class="card-header text-center">
            <h2>{{ config('app.name') }}</h2>
        </div>

        <!-- /.login-box-body -->
        <!-- <div class="card"> -->
        <div class="card-body login-card-body">
            <!-- <p class="login-box-msg">Sign in to start your session</p> -->

            @if (session()->has('loginError'))
            <p class="login-box-msg">
            <div class='login-box-msg alert alert-danger alert-dismissible' align='center'>
                {{ app(CustomClass::class)->notifGagalLogin() }}
            </div>
            </p>
            @endif

            <form method="post" action="{{ route('login.custom') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                <div class="row">
                    <div class="col-8">
                        <!-- <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember Me</label>
                        </div> -->
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
    <!-- /.login-card-body -->
    </div>

    <body class="hold-transition login-page">
        @endsection --}}
