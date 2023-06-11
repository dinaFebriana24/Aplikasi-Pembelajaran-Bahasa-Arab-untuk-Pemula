@extends('layouts.dashboard.master')

@section('page')
Dashboard
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('css')
<style>
    .card {
        background-color: #E9F4F5;
        margin-bottom: 10px;
        padding-top: 10px;
    }

    .card-body {
        margin: 5px 20px 20px 20px;
        background-color: #B0B0B0 !important;
        border: 1px solid #F5F9FA;
        border-radius: 8px;
    }

    .card-body > a {
        position: absolute;
        left: 40px;
        font-size: 28px;
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

<div class="row">
    @foreach ($main_categories as $main_category)
    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-sm-8 col-xs-12">
        <div class="card text-center">
            <p class="mb-0"><i class="fa-solid fa-memo-pad"></i>{{ $main_category->name }}</p>
                <div class="card-body ">
                    <p class="mb-0">Skor : 
                    @php
                        $score = App\Models\Score::where('main_category_id', $main_category->id)->where('created_by', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
                        @endphp
                    @if($score != null)
                        {{ $score->score }}
                    @else
                    0
                    @endif
                    / 100</p>
                </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
