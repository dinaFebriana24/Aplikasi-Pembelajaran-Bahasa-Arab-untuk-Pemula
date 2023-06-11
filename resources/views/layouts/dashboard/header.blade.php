<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    @yield('css')
  </head>
  <body>
    @include('layouts.dashboard.sidebar')

    <div id="main" class="main-open">
        @include('layouts.dashboard.navbar')
        <div class="container">
            <div class="row mb-2">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h3 class="page-name">@yield('page')</h3>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-list">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
            </div>