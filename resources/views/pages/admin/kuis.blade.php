@extends('layouts.dashboard.master')

@section('page')
Kuis
@endsection

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">Admin</li>
<li class="breadcrumb-item active" aria-current="page">Kuis</li>
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
                        <h5 class="sub-title-page">List Kuis dari kategori: {{ $main_category->name }}</h5>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <a href="#" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addKuis{{ $main_category->id }}">Tambah Kuis</a>
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
                    <div class="modal fade" id="addKuis{{ $main_category->id }}" tabindex="-1" aria-labelledby="addKuis{{ $main_category->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addKuis{{ $main_category->id }}Label">Tambah Kuis</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('admin/kuis') }}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="maincategoryID" value="{{ $main_category->id }}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Soal</label>
                                            <input type="text" class="form-control " id="teks" name="teks" placeholder="contoh: Huruf" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="gambar" class="form-label">Gambar</label>
                                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label for="audio" class="form-label">Audio</label>
                                            <input type="file" class="form-control" id="sound" name="sound" accept="audio/*" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Jawaban A</label>
                                            <input type="text" class="form-control " id="answer_a" name="answer_a" placeholder="contoh: Huruf" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Jawaban B</label>
                                            <input type="text" class="form-control " id="answer_b" name="answer_b" placeholder="contoh: Huruf" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Jawaban C</label>
                                            <input type="text" class="form-control " id="answer_c" name="answer_c" placeholder="contoh: Huruf" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="correct" class="form-label">Jawaban Benar</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="correct" id="a" value="a" checked>
                                                <label class="form-check-label" for="a">
                                                a
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="correct" id="b" value="b">
                                                <label class="form-check-label" for="b">
                                                b
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="correct" id="c" value="c">
                                                <label class="form-check-label" for="c">
                                                c
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Skor</label>
                                            <input type="text" class="form-control capitalize" id="score" name="score" placeholder="contoh: Huruf" required>
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
                                <th scope="col">Soal</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Audio</th>
                                <th scope="col">Jawaban A</th>
                                <th scope="col">Jawaban B</th>
                                <th scope="col">Jawaban C</th>
                                <th scope="col">Jawaban Benar</th>
                                <th scope="col">Skor</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($Quiz as $quiz)
                                @if($quiz->main_category_id == $main_category->id)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $quiz->teks }}</td>
                                    <td>
                                    @if($quiz->gambar != null)
                                        <img src="{{ asset('storage/gambar/quiz') . '/' .$quiz->gambar }}" height=100 alt="Gambar">
                                    @else
                                    -
                                    @endif
                                    </td>
                                    <td>
                                    @if($quiz->sound != null)
                                        <audio controls>
                                        <source src="{{ asset('storage/sound/quiz') . '/' .$quiz->sound }}" type="audio/mpeg"></audio></td>    
                                    @else
                                    -
                                    @endif
                                    </td>
                                    <td>{{ $quiz->answer_a }}</td>
                                    <td>{{ $quiz->answer_b }}</td>
                                    <td>{{ $quiz->answer_c }}</td>
                                    <td>
                                        @if($quiz->correct == 'a')
                                           <label>a</label>
                                        @elseif($quiz->correct == 'b')
                                            <label>b</label>
                                        @else
                                            <label>c</label>
                                        @endif
                                    </td>
                                    <td>{{ $quiz->score }}</td>

                                    <td>
                                        <form action="{{ url('/admin/kuis', $quiz->id ) }}" method="POST" class="ms-auto">
                                            <button type="button" class="btn btn-sm btn-warning mb-2 mb-lg-0 mb-xl-0 mb-xxl-0" data-bs-toggle="modal" data-bs-target="#editKuis{{ $quiz->id }}"><i class="fa fa-pencil"></i> Ubah</button>
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                    <!-- Modal  -->
                                    <div class="modal fade" id="editKuis{{ $quiz->id }}" tabindex="-1" aria-labelledby="editKuis{{ $quiz->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editKuis{{ $quiz->id }}Label">Edit Kuis</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('admin/kuis') . '/' . $quiz->id }}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="maincategoryID" value="{{ $main_category->id }}">
                                                    <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Soal</label>
                                                        <input type="text" class="form-control " id="teks" name="teks" placeholder="contoh: Huruf" value="{{ $quiz->teks }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="gambar" class="form-label">Gambar</label>
                                                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" value="{{ $quiz->gambar }} ">
                                                        @if($quiz->gambar != null)
                                                        <img src="{{ asset('storage/gambar/quiz') . '/' .$quiz->gambar }}" height=50 alt="Gambar">
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="audio" class="form-label">Audio</label>
                                                        <input type="file" class="form-control" id="sound" name="sound" accept="audio/*"  >
                                                        @if($quiz->sound != null)
                                                            <audio controls class="mt-3">
                                                            <source src="{{ asset('storage/sound/quiz') . '/' .$quiz->sound }}" type="audio/mpeg"></audio></td>    
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Jawaban A</label>
                                                        <input type="text" class="form-control " id="answer_a" name="answer_a" placeholder="contoh: Huruf" value="{{ $quiz->answer_a }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Jawaban B</label>
                                                        <input type="text" class="form-control " id="answer_b" name="answer_b" placeholder="contoh: Huruf" value="{{ $quiz->answer_b }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Jawaban C</label>
                                                        <input type="text" class="form-control " id="answer_c" name="answer_c" placeholder="contoh: Huruf" value="{{ $quiz->answer_c }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="correct" class="form-label">Jawaban Benar</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="correct" id="a" value="a" checked>
                                                            <label class="form-check-label" for="a">
                                                            a
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="correct" id="b" value="b">
                                                            <label class="form-check-label" for="b">
                                                            b
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="correct" id="c" value="c">
                                                            <label class="form-check-label" for="c">
                                                            c
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Skor</label>
                                                        <input type="text" class="form-control capitalize" id="score" name="score" placeholder="contoh: Huruf" value="{{ $quiz->score }}" required>
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
            <div class="tab-pane fade" id="nav-{{ $main_category->id }}" role="tabpanel" aria-labelledby="nav-{{ $main_category->id }}-tab" tabindex="0">
                <div class="row mt-3">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h5 class="sub-title-page">List Kuis dari Main kategori: {{ $main_category->name }}</h5>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-end">
                        <a href="#" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addKuis{{ $main_category->id }}">Tambah Kuis</a>
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
                    <div class="modal fade" id="addKuis{{ $main_category->id }}" tabindex="-1" aria-labelledby="addKuis{{ $main_category->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addKuis{{ $main_category->id }}Label">Tambah Kuis</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('admin/kuis') }}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="maincategoryID" value="{{ $main_category->id }}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Soal</label>
                                            <input type="text" class="form-control " id="teks" name="teks" placeholder="contoh: Huruf"  required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="gambar" class="form-label">Gambar</label>
                                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label for="audio" class="form-label">Audio</label>
                                            <input type="file" class="form-control" id="sound" name="sound" accept="audio/*" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Jawaban A</label>
                                            <input type="text" class="form-control " id="answer_a" name="answer_a" placeholder="contoh: Huruf"  required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Jawaban B</label>
                                            <input type="text" class="form-control " id="answer_b" name="answer_b" placeholder="contoh: Huruf"  required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Jawaban C</label>
                                            <input type="text" class="form-control " id="answer_c" name="answer_c" placeholder="contoh: Huruf"  required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="correct" class="form-label">Jawaban Benar</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="correct" id="a" value="a" checked>
                                                <label class="form-check-label" for="a">
                                                a
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="correct" id="b" value="b">
                                                <label class="form-check-label" for="b">
                                                b
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="correct" id="c" value="c">
                                                <label class="form-check-label" for="c">
                                                c
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Skor</label>
                                            <input type="text" class="form-control capitalize" id="score" name="score" placeholder="contoh: Huruf" required>
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
                                <th scope="col">Soal</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Audio</th>
                                <th scope="col">Jawaban A</th>
                                <th scope="col">Jawaban B</th>
                                <th scope="col">Jawaban C</th>
                                <th scope="col">Jawaban Benar</th>
                                <th scope="col">Skor</th>
                                <th scope="col">Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($Quiz as $quiz)
                                @if($quiz->main_category_id == $main_category->id)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $quiz->teks }}</td>
                                    <td>
                                        @if($quiz->gambar != null)
                                        <img src="{{ asset('storage/gambar/quiz') . '/' .$quiz->gambar }}" height=100 alt="Gambar">
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if($quiz->sound != null)
                                        <audio controls>
                                        <source src="{{ asset('storage/sound/quiz') . '/' .$quiz->sound }}" type="audio/mpeg"></audio></td>    
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>{{ $quiz->answer_a }}</td>
                                    <td>{{ $quiz->answer_b }}</td>
                                    <td>{{ $quiz->answer_c }}</td>
                                    <td>
                                        @if($quiz->correct == 'a')
                                           <label>a</label>
                                        @elseif($quiz->correct == 'b')
                                            <label>b</label>
                                        @else
                                            <label>c</label>
                                        @endif
                                    </td>
                                    <td>{{ $quiz->score }}</td>

                                    <td>
                                        <form action="{{ url('/admin/kuis', $quiz->id ) }}" method="POST" class="ms-auto">
                                            <button type="button" class="btn btn-sm btn-warning mb-2 mb-lg-0 mb-xl-0 mb-xxl-0" data-bs-toggle="modal" data-bs-target="#editKuis{{ $quiz->id }}"><i class="fa fa-pencil"></i> Ubah</button>
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="editKuis{{ $quiz->id }}" tabindex="-1" aria-labelledby="editKuis{{ $quiz->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editKuis{{ $quiz->id }}Label">Edit Kuis </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('admin/kuis') . '/' . $quiz->id }}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="maincategoryID" value="{{ $main_category->id }}">
                                                    
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Soal</label>
                                                            <input type="text" class="form-control " id="teks" name="teks" placeholder="contoh: Huruf" value="{{ $quiz->teks }}"  required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="gambar" class="form-label">Gambar</label>
                                                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                                            @if($quiz->gambar != null)
                                                                <img src="{{ asset('storage/gambar/quiz') . '/' .$quiz->gambar }}" height=50 alt="Gambar">
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="audio" class="form-label">Audio</label>
                                                            <input type="file" class="form-control" id="sound" name="sound" accept="audio/*" >
                                                            @if($quiz->sound != null)
                                                                <audio controls class="mt-3">
                                                                <source src="{{ asset('storage/sound/quiz') . '/' .$quiz->sound }}" type="audio/mpeg"></audio></td>    
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Jawaban A</label>
                                                            <input type="text" class="form-control " id="answer_a" name="answer_a" placeholder="contoh: Huruf" value="{{ $quiz->answer_a }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Jawaban B</label>
                                                            <input type="text" class="form-control " id="answer_b" name="answer_b" placeholder="contoh: Huruf" value="{{ $quiz->answer_b }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Jawaban C</label>
                                                            <input type="text" class="form-control " id="answer_c" name="answer_c" placeholder="contoh: Huruf" value="{{ $quiz->answer_c }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="correct" class="form-label">Jawaban Benar</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="correct" id="a" value="a" checked>
                                                                <label class="form-check-label" for="a">
                                                                a
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="correct" id="b" value="b">
                                                                <label class="form-check-label" for="b">
                                                                b
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="correct" id="c" value="c">
                                                                <label class="form-check-label" for="c">
                                                                c
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Skor</label>
                                                            <input type="text" class="form-control capitalize" id="score" name="score" placeholder="contoh: Huruf" value="{{ $quiz->score }}" required>
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