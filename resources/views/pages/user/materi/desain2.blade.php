@extends('layouts.dashboard.master')

@section('page')
{{ $category->name }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
@endsection

@section('css')
<style>
    .card {
        background-color: #D9D9D9;
        margin-bottom: 10px;
    }

    .teori-image {
        padding: 20px 20px 0px 20px;
        height: 150px;
    }

    .card-body {
        margin: 5px 20px 20px 20px;
        background-color: #F9F6F6 !important;
        border: 1px solid #000;
    }

    .card-body > a {
        position: absolute;
        left: 40px;
        font-size: 28px;
        color: #4CBFB7;
    }

    @media screen and (min-width: 768px;) and (max-width: 989px;) {
        .card-body > a {
            left: 10px !important;
            font-size: 24px !important;
        }
    }
</style>
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
<h5 class="sub-title-page">Nama {{ $category->name }}</h5>

@if($audionya != null)

    <audio autoplay="true"><source src="{{ asset('storage/audio/materi') .'/'. $audionya }}" alt="Huruf {{ $namanya }}" class="img-thumbnail img-desain1"></audio>
@endif
<div class="row">
    @foreach ($theories as $theory)
    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-sm-8 col-xs-12">
        <div class="card">
            <div class="bg-image hover-overlay">
                <img class="card-img-top teori-image" src="{{ asset('storage/img/materi') .'/'. $theory->image }}" alt="Card image cap">
            </div>
            <div class="card-body text-center">
                <a href="/{{ $category->name }}/{{ $theory->name }}"><i class="fa fa-play"></i></a>
                <h5 class="h5 font-weight-bold">{{ $theory->arab }}</h5>
                <p class="mb-0">{{ $theory->name }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection



