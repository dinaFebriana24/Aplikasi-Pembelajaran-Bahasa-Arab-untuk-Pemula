@extends('layouts.user.auth')

@section('content')
<section class="w-100 h-auto mt-5 mb-5">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Nama Lengkap <span class="text-danger">*</span></label>

                        <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Photo input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Foto Profile <span class="text-danger">*</span></label>

                        <input id="photo" type="file" class="form-control form-control-lg @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}" autofocus required>
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Alamat Email <span class="text-danger">*</span></label>

                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan alamat email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Kata Sandi <span class="text-danger">*</span></label>

                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Masukkan kata sandi">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Re-Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>

                        <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password" placeholder="Masukkan ulang kata sandi">
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Daftar</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Sudah punya akun?
                            <a href="{{ route('login') }}"class="link-danger">Login</a>
                        </p>
                    </div>
                </form>
            </div>
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="{{ asset('img/register.png') }}"
                class="img-fluid" alt="Sample image">
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script>
    date_of_birth.max = new Date().toISOString().split("T")[0];
</script>
@endsection