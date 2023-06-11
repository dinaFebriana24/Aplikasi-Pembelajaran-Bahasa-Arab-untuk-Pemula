@extends('layouts.dashboard.master')

@section('page')
{{ $main_category->name }} - Score
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><a href="/{{ $main_category->name }}">{{ $main_category->name }}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="/{{ $main_category->name }}/quiz">Quiz</a></li>
    <li class="breadcrumb-item active" aria-current="page">Score</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('img/star.png') }}" alt="Star Logo" class="mt-5 mb-3">
            <h3 class="mt-3">Selamat anda telah menyelesaikan kuis !</h3>
            <h5>Skor yang anda dapatkan : {{ $check }}</h5>
            <a href="/home" class="btn btn-primary mt-3">Kembali ke dashboard</a>
        </div>
    </div>
@endsection