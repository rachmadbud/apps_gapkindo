@extends('auth.app')
@section('content')

    @php
        use App\Models\CustomClass;
    @endphp

    <br>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-dark">
                <div class="card-header text-center">
                    <h2>{{ config('app.name') }}</h2>
                </div>
                <div class="card-body login-card-body">
                    @if (session()->has('notifResetPassword'))
                        <p class="login-box-msg">
                        <div class='login-box-msg alert alert-warning alert-dismissible' align='center'>
                            {{ session('notifResetPassword') }}
                        </div>
                        </p>
                    @endif

                    @if (count($errors) > 0)
                        <div class="card-footer">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form id="quickForm" action="{{ app(CustomClass::class)->rootApp() }}/gantiPassword/proses"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- <div class="input-group mb-3">
                                    <input type="email" name="email" value="{{ auth()->user()->email }}" placeholder="Email"
                                        class="form-control @error('email') is-invalid @enderror" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                    </div>
                                    @error('email')
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
                                </div> -->

                        <div class="input-group mb-3">
                            <input type="text" name="name" value="{{ auth()->user()->name }}" placeholder="Name"
                                class="form-control" readonly>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                            @error('nrik')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" placeholder="Password Lama"
                                class="form-control @error('password') is-invalid @enderror" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password_baru" placeholder="Password Baru"
                                class="form-control @error('password') is-invalid @enderror" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="konfirmasi_password_baru" placeholder="Konfirmasi Password Baru"
                                class="form-control @error('password') is-invalid @enderror" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <p class="text-info">Password harus terdiri dari kombinasi huruf besar (A-Z), huruf kecil
                                    (a-z),
                                    angka (0-9)
                                    dan
                                    spesial karakter</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-danger btn-block">Ganti Password</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endsection
