<nav class="navbar navbar-custom">
    <div class="container-fluid">
        <button onclick="openNav()" class="button-sidebar">
            <i class="fa fa-bars"></i>
        </button>
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hi, {{ Auth::user()->name }}
            @if(Auth::user()->photo != null)
            <img src="{{ asset('/storage/img/profile/' . Auth::user()->photo) }}" alt="Foto {{ Auth::user()->name }}" class="rounded-circle" width="50" height="50">
            @else
            <img src="{{ asset('img/picture.png') }}" alt="Foto {{ Auth::user()->name }}" height="50">
            @endif
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-user"></i> Ubah Profile</a></li>
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
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="changePasswordLabel">Ubah Kata Sandi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('change-password') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="oldPassword" class="form-label">Kata Sandi Lama</label>
                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Masukkan kata sandi anda">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="oldPassword" name="newPassword" placeholder="Masukkan kata sandi baru anda">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="oldPassword" name="newPassword_confirmation" placeholder="Masukkan lagi kata sandi baru anda">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>