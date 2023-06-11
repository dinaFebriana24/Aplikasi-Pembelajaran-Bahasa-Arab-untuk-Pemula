@extends('layouts.dashboard.master')

@section('page')
Main Kategori
@endsection

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">Admin</li>
<li class="breadcrumb-item active" aria-current="page">Main Kategori</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h5 class="sub-title-page">List Main Kategori</h5>
    </div>
    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <a href="#" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addKategori">Tambah Kategori</a>
    </div>

    <div class="col-12 mt-3">
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
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addKategori" tabindex="-1" aria-labelledby="addKategoriLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addKategoriLabel">Tambah Main Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('admin/mainkategori') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Main Kategori</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="contoh: Huruf" required>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="overflow-x-auto">
    <table class="table table-hover overflow-x-auto">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Main Kategori</th>
                
               
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($main_categories as $main_category)
            <tr>
                <th scope="row">{{ $loop->index+1 }}</th>
                <td>{{ $main_category->name }}</td>
            
                <td>
                    <form action="{{ url('/admin/mainkategori', $main_category->name ) }}" method="POST" class="ms-auto">
                        <button type="button" class="btn btn-sm btn-warning mb-2 mb-lg-0 mb-xl-0 mb-xxl-0" data-bs-toggle="modal" data-bs-target="#editKategori{{ $main_category->id }}"><i class="fa fa-pencil"></i> Ubah</button>
                        @method('delete')
                        @csrf
                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus</button>
                    </form>
                </td>
                <!-- Modal -->
                <div class="modal fade" id="editKategori{{ $main_category->id }}" tabindex="-1" aria-labelledby="editKategori{{ $main_category->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editKategori{{ $main_category->id }}Label">Edit Kategori {{ $main_category->name }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ url('admin/mainkategori') . '/' . $main_category->name }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Kategori</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="contoh: Huruf" value="{{ $main_category->name }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection