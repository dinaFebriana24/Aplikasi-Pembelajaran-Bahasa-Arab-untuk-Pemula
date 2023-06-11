@extends('layouts.dashboard.master')

@section('page')
Kategori
@endsection

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">Admin</li>
<li class="breadcrumb-item active" aria-current="page">Kategori</li>
@endsection

@section('content')
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @foreach($main_categories as $main_category)
            @if($loop->index == 0)
                <button class="nav-link active" id="nav-{{ $main_category->id }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $main_category->id }}" type="button" role="tab" aria-controls="nav-{{ $main_category->id }}" aria-selected="true">{{ $main_category->name }}</button>
            @else
                <button class="nav-link" id="nav-{{ $main_category->id }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $main_category->id }}" type="button" role="tab" aria-controls="nav-{{ $main_category->id }}" aria-selected="false">{{ $main_category->name }}</button>
            @endif
        @endforeach
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    @foreach($main_categories as $main_category)
        @if($loop->index == 0)
            <div class="tab-pane fade show active" id="nav-{{ $main_category->id }}" role="tabpanel" aria-labelledby="nav-{{ $main_category->id }}-tab" tabindex="0">
                <div class="row mt-3">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h5 class="sub-title-page">List Kategori dari Main kategori: {{ $main_category->name }}</h5>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <a href="#" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addMateri{{ $main_category->id }}">Tambah Kategori</a>
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
                    <!-- Modal  -->
                    <div class="modal fade" id="addMateri{{ $main_category->id }}" tabindex="-1" aria-labelledby="addMateri{{ $main_category->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addMateri{{ $main_category->id }}Label">Tambah Kategori</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('admin/kategori') }}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="maincategoryID" value="{{ $main_category->id }}">
                            
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Kategori</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="contoh: Huruf" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="penjelasan" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="penjelasan" name="penjelasan" placeholder="contoh: bab ini menjelaskan ..." ></textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="desain" class="form-label">Desain Tampilan</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="desain" id="desain1" value="1" checked>
                                                <label class="form-check-label" for="desain1">
                                                    <img src="{{ asset('img/desain1.png') }}" alt="Desain tampilan 1" height="100">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="desain" id="desain2" value="2">
                                                <label class="form-check-label" for="desain2">
                                                    <img src="{{ asset('img/desain2.png') }}" alt="Desain tampilan 2" height="100">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="desain" id="desain3" value="3">
                                                <label class="form-check-label" for="desain3">
                                                    <img src="{{ asset('img/desain3.png') }}" alt="Desain tampilan 3" height="100">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="desain" id="desain4" value="4">
                                                <label class="form-check-label" for="desain4">
                                                    <img src="{{ asset('img/desain4.png') }}" alt="Desain tampilan 4" height="100">
                                                </label>
                                            </div>
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Desain</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                @if($category->main_category_id == $main_category->id)
                                    <tr>
                                        <th scope="row">{{ $loop->index+1 }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->penjelasan }}</td>
                                        <td>
                                           
                                            @if($category->design == 1)
                                                <img src="{{ asset('img/desain1.png') }}" height=100 alt="Desain {{ $category->name }}">
                                            @elseif($category->design == 2)
                                                <img src="{{ asset('img/desain2.png') }}" height=100 alt="Desain {{ $category->name }}">
                                            @elseif($category->design == 3)
                                                <img src="{{ asset('img/desain3.png') }}" height=100 alt="Desain {{ $category->name }}">
                                            @else
                                                <img src="{{ asset('img/desain4.png') }}" height=100 alt="Desain {{ $category->name }}">        
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ url('/admin/kategori', $category->id ) }}" method="POST" class="ms-auto">
                                                <button type="button" class="btn btn-sm btn-warning mb-2 mb-lg-0 mb-xl-0 mb-xxl-0" data-bs-toggle="modal" data-bs-target="#editMateri{{ $category->id }}"><i class="fa fa-pencil"></i> Ubah</button>
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus</button>
                                            </form>
                                        </td>
                                        <!-- Modal  -->
                                        <div class="modal fade" id="editMateri{{ $category->id }}" tabindex="-1" aria-labelledby="editMateri{{ $category->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editMateri{{ $category->id }}Label">Edit Materi {{ $category->name }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ url('admin/kategori') . '/' . $category->id }}" method="POST" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="hidden" name="maincategoryID" value="{{ $main_category->id }}">
                                                        
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Nama Kategori</label>
                                                                <input type="text" class="form-control " id="name" name="name" placeholder="contoh: Huruf" value="{{ $category->name }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="penjelasan" class="form-label">Deskripsi</label>
                                                                <textarea class="form-control" id="penjelasan" name="penjelasan" placeholder="contoh: bab ini menjelaskan ..." >{{ $category->penjelasan }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="desain" class="form-label">Desain Tampilan</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="desain" id="desain1" value="1" checked>
                                                                        <label class="form-check-label" for="desain1">
                                                                            <img src="{{ asset('img/desain1.png') }}" alt="Desain tampilan 1" height="100">
                                                                        </label>
                                                                    </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="desain" id="desain2" value="2" >
                                                                    <label class="form-check-label" for="desain2">
                                                                        <img src="{{ asset('img/desain2.png') }}" alt="Desain tampilan 2" height="100">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="desain" id="desain3" value="3">
                                                                    <label class="form-check-label" for="desain3">
                                                                        <img src="{{ asset('img/desain3.png') }}" alt="Desain tampilan 3" height="100">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="desain" id="desain4" value="4">
                                                                    <label class="form-check-label" for="desain4">
                                                                        <img src="{{ asset('img/desain4.png') }}" alt="Desain tampilan 4" height="100">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="tab-pane fade" id="nav-{{ $main_category->id }}" role="tabpanel" aria-labelledby="nav-{{ $main_category->id }}-tab" tabindex="0">
                <div class="row mt-3">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h5 class="sub-title-page">List Kategori dari Main kategori: {{ $main_category->name }}</h5>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-end">
                        <a href="#" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addMateri{{ $main_category->id }}">Tambah Kategori</a>
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
                    <div class="modal fade" id="addMateri{{ $main_category->id }}" tabindex="-1" aria-labelledby="addMateri{{ $main_category->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addMateri{{ $main_category->id }}Label">Tambah Kategori</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('admin/kategori') }}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="maincategoryID" value="{{ $main_category->id }}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Kategori</label>
                                            <input type="text" class="form-control " id="name" name="name" placeholder="contoh: Huruf" >
                                        </div>
                                       <div class="mb-3">
                                            <label for="penjelasan" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="penjelasan" name="penjelasan" placeholder="contoh: bab ini menjelaskan ..." ></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="desain" class="form-label">Desain Tampilan</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="desain" id="desain1" value="1" checked>
                                                <label class="form-check-label" for="desain1">
                                                    <img src="{{ asset('img/desain1.png') }}" alt="Desain tampilan 1" height="100">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="desain" id="desain2" value="2" checked>
                                                <label class="form-check-label" for="desain2">
                                                    <img src="{{ asset('img/desain2.png') }}" alt="Desain tampilan 2" height="100">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="desain" id="desain3" value="3">
                                                <label class="form-check-label" for="desain3">
                                                    <img src="{{ asset('img/desain3.png') }}" alt="Desain tampilan 3" height="100">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="desain" id="desain4" value="4">
                                                <label class="form-check-label" for="desain4">
                                                    <img src="{{ asset('img/desain4.png') }}" alt="Desain tampilan 4" height="100">
                                                </label>
                                            </div>
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
                    <table class="table table-hover">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Desain</th>
                            <th scope="col">Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                @if($category->main_category_id == $main_category->id)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->penjelasan }}</td>
                                    <td>
                                       
                                        @if($category->design == 1)
                                                <img src="{{ asset('img/desain1.png') }}" height=100 alt="Desain {{ $category->name }}">
                                        @elseif($category->design == 2)
                                            <img src="{{ asset('img/desain2.png') }}" height=100 alt="Desain {{ $category->name }}">
                                        @elseif($category->design == 3)
                                            <img src="{{ asset('img/desain3.png') }}" height=100 alt="Desain {{ $category->name }}">
                                        @else
                                            <img src="{{ asset('img/desain4.png') }}" height=100 alt="Desain {{ $category->name }}">        
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ url('/admin/kategori', $category->id ) }}" method="POST" class="ms-auto">
                                            <button type="button" class="btn btn-sm btn-warning mb-2 mb-lg-0 mb-xl-0 mb-xxl-0" data-bs-toggle="modal" data-bs-target="#editMateri{{ $category->id }}"><i class="fa fa-pencil"></i> Ubah</button>
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="editMateri{{ $category->id }}" tabindex="-1" aria-labelledby="editMateri{{ $category->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editMateri{{ $category->id }}Label">Edit Materi {{ $category->name }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('admin/kategori') . '/' . $category->id }}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="maincategoryID" value="{{ $main_category->id }}">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nama Kategori</label>
                                                            <input type="text" class="form-control " id="name" name="name" placeholder="contoh: Huruf" value="{{ $category->name }}" >
                                                        </div>
                                                       <div class="mb-3">
                                                            <label for="penjelasan" class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" id="penjelasan" name="penjelasan" placeholder="contoh: bab ini menjelaskan ..."  >{{ $category->penjelasan }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="desain" class="form-label">Desain Tampilan</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="desain" id="desain1" value="1" checked>
                                                                <label class="form-check-label" for="desain1">
                                                                    <img src="{{ asset('img/desain1.png') }}" alt="Desain tampilan 1" height="100">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="desain" id="desain2" value="2" checked>
                                                                <label class="form-check-label" for="desain2">
                                                                    <img src="{{ asset('img/desain2.png') }}" alt="Desain tampilan 2" height="100">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="desain" id="desain3" value="3">
                                                                <label class="form-check-label" for="desain3">
                                                                    <img src="{{ asset('img/desain3.png') }}" alt="Desain tampilan 3" height="100">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="desain" id="desain4" value="4">
                                                                <label class="form-check-label" for="desain4">
                                                                    <img src="{{ asset('img/desain4.png') }}" alt="Desain tampilan 4" height="100">
                                                                </label>
                                                            </div>
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
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endforeach
</div>
@endsection


