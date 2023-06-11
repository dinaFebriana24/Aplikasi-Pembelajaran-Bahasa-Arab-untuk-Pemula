@extends('layouts.dashboard.master')

@section('page')
Ubah Profile
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Profile</li>
@endsection

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(Session::has('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('fail') }}
            @php
                Session::forget('fail');
            @endphp
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    <div class="row">
        <div class="col-md-12 text-center">
            @if(Auth::user()->photo)
            <img src="{{ asset('storage/img/profile') . '/' . Auth::user()->photo }}" alt="Star Logo" class="mt-5 mb-3" class="rounded-circle" width="100" height="100">
            @else
            <img src="{{ asset('img/picture.png') }}" alt="Star Logo" class="mt-5 mb-3" class="rounded-circle" width="100" height="100">
            @endif
            <form method="post" action="{{ route('profile-edit') }}" class="text-start" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Ubah Foto Profil</label>
                    <div class="col-sm-10">
                        <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Alamat Email</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" name="email" id="email" value="{{ Auth::user()->email }}" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Profile</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ Auth::user()->name }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
@endsection