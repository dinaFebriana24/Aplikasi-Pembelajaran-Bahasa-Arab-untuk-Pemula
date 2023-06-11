@extends('layouts.dashboard.master')

@section('page')
{{ $category->name }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
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
<p>{{ $category->penjelasan }}</p>

    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if($gambarnya == null)
            <img src="{{ asset('img/no-picture.png') }}" alt="Tidak ada gambar" class="img-thumbnail img-desain2">
        @else
            <img src="{{ asset('storage/img/materi') .'/'. $gambarnya }}"  class="img-thumbnail img-desain2">
            @endif

        @if($audionya != null)       
           
            <audio autoplay="true">
                <source src="{{ asset('storage/audio/materi') .'/'. $audionya }}"  class="img-thumbnail img-desain2">
            </audio>
        @endif
    </div>

    <div class="box">
        <div class="row">
            @foreach($theories as $theory)
            <a href="/{{ $category->name }}/{{ $theory->name }}" class="col-angka">
                {{ $theory->name }}
            </a>
            @endforeach
        </div>
    </div>
</div>

@endsection


