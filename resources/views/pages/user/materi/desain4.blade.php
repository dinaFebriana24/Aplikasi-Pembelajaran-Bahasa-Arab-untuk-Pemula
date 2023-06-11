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

    <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="row text-center">
                @foreach($theories as $theory)
                    @if($theory->arab == null)
                        <p class="col-4 col-arabicT">
                            {{ $theory->name }}
                        </p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

            <div class="row text-center">
                @foreach($theories as $theory)
                    @if($theory->arab != null)
                        <a href="/{{ $category->name }}/{{ $theory->name }}" class="col-4 col-arabic">
                            {{ $theory->arab }}
                        </a> 
                    @endif
                @endforeach
            </div>

        </div>

        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
            
            @if($gambarnya == null)
                <img src="{{ asset('img/no-picture.png') }}" alt="Tidak ada gambar" class="img-thumbnail img-desain1">
            @else
                <img src="{{ asset('storage/img/materi') .'/'. $gambarnya }}" alt="Huruf {{ $theory->name }}" class="img-thumbnail img-desain1">
            @endif

            @if($audionya != null)
                
                <audio autoplay="true"><source src="{{ asset('storage/audio/materi') .'/'. $audionya }}" alt="Huruf {{ $theory->name }}" class="img-thumbnail img-desain1"></audio>
            @endif

            
        </div>
    </div>

    
@endsection



