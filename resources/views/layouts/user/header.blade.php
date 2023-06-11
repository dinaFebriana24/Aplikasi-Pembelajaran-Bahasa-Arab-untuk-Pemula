<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_NAME') }} | {{ env('APP_DESC') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
        @yield('css')
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-light">
          <!-- Container wrapper -->
          <div class="container">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="/">
              <img src="{{ asset('img/logo.png') }}" height="40" width="168" alt="Ta'allum" loading="lazy" />
            </a>

            <!-- Right elements -->
            <div class="d-flex align-items-center">
              <!-- Avatar -->
              <div class="navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @guest
                    @if (Route::has('login'))
                      <li class="nav-item me-3 me-sm-none me-xs-none">
                        <a class="nav-link" aria-current="page" href="{{ route('login') }}">Masuk</a>
                      </li>
                    @endif

                    @if (Route::has('register'))
                      <li class="nav-item">
                        <a class="btn btn-primary" aria-current="page" href="{{ route('register') }}">Daftar</a>
                      </li>
                    @endif
                  @else
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle hidden-arrow" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                        <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="ms-2 rounded-circle" height="35" alt="{{ Auth::user()->name }}" loading="lazy" />
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePassword"><i class="fa-sharp fa-solid fa-unlock-keyhole"></i> Ubah Kata Sandi</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                  <i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i> Keluar
                            </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
                        </li>
                      </ul>
                    </li>
                  @endguest
                </ul>
              </div>
            </div>
            <!-- Right elements -->
          </div>
          <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->