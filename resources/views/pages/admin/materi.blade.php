@extends('layouts.dashboard.master')

@section('page')
Materi
@endsection

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">Admin</li>
<li class="breadcrumb-item active" aria-current="page">Materi</li>
@endsection

@section('content')
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @foreach($categories as $category)
            @if($loop->index == 0)
                <button class="nav-link active" id="nav-{{ $category->id }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $category->id }}" type="button" role="tab" aria-controls="nav-{{ $category->id }}" aria-selected="true">{{ $category->name }}</button>
            @else
                <button class="nav-link" id="nav-{{ $category->id }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $category->id }}" type="button" role="tab" aria-controls="nav-{{ $category->id }}" aria-selected="false">{{ $category->name }}</button>
            @endif
        @endforeach
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    @foreach($categories as $category)
        @if($loop->index == 0)
            <div class="tab-pane fade show active" id="nav-{{ $category->id }}" role="tabpanel" aria-labelledby="nav-{{ $category->id }}-tab" tabindex="0">
                <div class="row mt-3">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h5 class="sub-title-page">List Materi dari kategori: {{ $category->name }}</h5>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <a href="#" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addMateri{{ $category->id }}">Tambah Materi</a>
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
                    <div class="modal fade" id="addMateri{{ $category->id }}" tabindex="-1" aria-labelledby="addMateri{{ $category->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addMateri{{ $category->id }}Label">Tambah Materi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('admin/materi') }}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="categoryID" value="{{ $category->id }}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Materi</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="contoh: Huruf" required >
                                        </div>
                                        <div class="mb-3">
                                            <label for="arab" class="form-label">Bahasa Arab</label>
                                            <input type="text" name="arab" class="form-control" onkeyup="arabicValue(arab)" dir="rtl" id="arab" placeholder="Contoh: ا"  >
                                        </div>
                                        <div class="mb-3">
                                            <label for="gambar" class="form-label">Gambar</label>
                                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="audio" class="form-label">Audio</label>
                                            <input type="file" class="form-control" id="audio" name="audio" accept="audio/*" >
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
                                <th scope="col">Bahasa Indonesia</th>
                                <th scope="col">Bahasa Arab</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Sound</th>
                                <th scope="col">Aksi</th>
                            
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($theories as $theory)
                                @if($theory->category_id == $category->id)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                  
                                    <td>{{ $theory->name }}</td>
                                    <td> @if($theory->arab != NULL) 
                                        {{ $theory->arab }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>@if($theory->image != NULL) 
                                        <img src="{{ asset('storage/img/materi') . '/' .$theory->image }}" height=100 alt="Gambar {{ $theory->name }}">
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>@if($theory->audio != NULL) 
                                        <audio controls>
                                            <source src="{{ asset('storage/audio/materi') . '/' .$theory->audio }}" type="audio/mpeg">
                                        </audio>
                                        @else
                                        -
                                        @endif
                                    </td>    
                                </td>
                                    
                                    <td>
                                        <form action="{{ url('/admin/materi', $theory->id ) }}" method="POST" class="ms-auto">
                                            <button type="button" class="btn btn-sm btn-warning mb-2 mb-lg-0 mb-xl-0 mb-xxl-0" data-bs-toggle="modal" data-bs-target="#editMateri{{ $theory->id }}"><i class="fa fa-pencil"></i> Ubah</button>
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                    <!-- Modal  -->
                                    <div class="modal fade" id="editMateri{{ $theory->id }}" tabindex="-1" aria-labelledby="editMateri{{ $theory->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editMateri{{ $theory->id }}Label">Edit Materi {{ $theory->name }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('admin/materi') . '/' . $theory->id }}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="categoryID" value="{{ $category->id }}">
                                                    
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nama Materi</label>
                                                            <input type="text" class="form-control " id="name" name="name" placeholder="contoh: Huruf" value="{{ $theory->name }}" required >
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="arab" class="form-label">Bahasa Arab</label>
                                                            <input type="text" name="arab" class="form-control" onkeyup="arabicValue(arab)" dir="rtl" id="arab" placeholder="Contoh: ا" value="{{ $theory->arab }}" >
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="gambar" class="form-label">Gambar</label>
                                                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*"  >
                                                            @if($theory->image != null)
                                                                <img src="{{ asset('storage/img/materi') . '/' .$theory->image }}" height=80 alt="Gambar">
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="audio" class="form-label">Audio</label>
                                                            <input type="file" class="form-control" id="audio" name="audio" accept="audio/*" >
                                                            @if($theory->audio != null)
                                                                <audio controls class="mt-3">
                                                                <source src="{{ asset('storage/audio/materi') . '/' .$theory->audio }}" type="audio/mpeg"></audio></td>    
                                                            @endif
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
        @else
            <div class="tab-pane fade" id="nav-{{ $category->id }}" role="tabpanel" aria-labelledby="nav-{{ $category->id }}-tab" tabindex="0">
                <div class="row mt-3">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h5 class="sub-title-page">List Materi dari kategori: {{ $category->name }}</h5>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-end">
                        <a href="#" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addMateri{{ $category->id }}">Tambah Materi</a>
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
                    <div class="modal fade" id="addMateri{{ $category->id }}" tabindex="-1" aria-labelledby="addMateri{{ $category->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addMateri{{ $category->id }}Label">Tambah Materi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('admin/materi') }}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="categoryID" value="{{ $category->id }}">
                                   
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Materi</label>
                                            <input type="text" class="form-control " id="name" name="name" placeholder="contoh: Huruf" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="arab" class="form-label">Bahasa Arab</label>
                                            <input type="text" name="arab" class="form-control" onkeyup="arabicValue(arab)" dir="rtl" id="arab" placeholder="Contoh: ا" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="gambar" class="form-label">Gambar</label>
                                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="audio" class="form-label">Audio</label>
                                            <input type="file" class="form-control" id="audio" name="audio" accept="audio/*" >
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
                                <th scope="col">Bahasa Indonesia</th>
                                <th scope="col">Bahasa Arab</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Sound</th>
                                <th scope="col">Aksi</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($theories as $theory)
                                @if($theory->category_id == $category->id)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>

                                    <td>{{ $theory->name }}</td>
                                    <td>@if($theory->arab != NULL) 
                                        {{ $theory->arab }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                     <td>@if($theory->image != NULL) 
                                        <img src="{{ asset('storage/img/materi') . '/' .$theory->image }}" height=100 alt="Gambar {{ $theory->name }}">
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>@if($theory->audio != NULL) 
                                        <audio controls>
                                            <source src="{{ asset('storage/audio/materi') . '/' .$theory->audio }}" type="audio/mpeg">
                                        </audio>
                                        @else
                                        -
                                        @endif
                                    </td>   
                                </td>
                                    
                                    <td>
                                        <form action="{{ url('/admin/materi', $theory->id ) }}" method="POST" class="ms-auto">
                                            <button type="button" class="btn btn-sm btn-warning mb-2 mb-lg-0 mb-xl-0 mb-xxl-0" data-bs-toggle="modal" data-bs-target="#editMateri{{ $theory->id }}"><i class="fa fa-pencil"></i> Ubah</button>
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="editMateri{{ $theory->id }}" tabindex="-1" aria-labelledby="editMateri{{ $theory->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editMateri{{ $theory->id }}Label">Edit Materi {{ $theory->name }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('admin/materi') . '/' . $theory->id }}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="categoryID" value="{{ $category->id }}">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nama Materi</label>
                                                            <input type="text" class="form-control " id="name" name="name" placeholder="contoh: Huruf" value="{{ $theory->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="arab" class="form-label">Bahasa Arab</label>
                                                            <input type="text" name="arab" class="form-control" onkeyup="arabicValue(arab)" dir="rtl" id="arab" placeholder="Contoh: ا" value="{{ $theory->arab }}" >
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="gambar" class="form-label">Gambar</label>
                                                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" >
                                                            @if($theory->image != null)
                                                                <img src="{{ asset('storage/img/materi') . '/' .$theory->image }}" height=80 alt="Gambar">
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="audio" class="form-label">Audio</label>
                                                            <input type="file" class="form-control" id="audio" name="audio" accept="audio/*" >
                                                            @if($theory->audio != null)
                                                                <audio controls class="mt-3">
                                                                <source src="{{ asset('storage/audio/materi') . '/' .$theory->audio }}" type="audio/mpeg"></audio></td>    
                                                            @endif
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

@section('javascript')
<script src="{{ asset('js/arab.js') }}"></script>
@endsection