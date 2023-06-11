@extends('layouts.dashboard.master')

@section('page')
{{ $main_category->name }} - Quiz
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Quiz</li>
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
    <p>Pillihlah jawaban yang benar!</p>
    <div class="row">
        <form action="/{{ $main_category->name }}/quiz/score" method="post">
            @csrf
            @foreach($Quiz as $quiz)
                <div class="col-md-12">
                    <h5 class="mb-2">{{ $loop->index+1 }}. {{ $quiz->teks }}</h5>

                @if($quiz->gambar != null)
                    <img class="card-img-top quiz-image" src="{{ asset('storage/gambar/quiz') .'/'. $quiz->gambar }}" alt="Card image cap">
                @endif  
                   
                @if($quiz->sound != null)
                
                    <audio controls>
                        <source src="{{ asset('storage/sound/quiz') . '/' .$quiz->sound }}" type="audio/mpeg">
                    </audio>
                @endif

                    <div class="form-check mb-2 mt-2">
                        <input class="form-check-input" type="radio" name="answer{{ $quiz->id }}" id="answer{{ $quiz->id }}" value="a" required>
                        <label class="form-check-label" for="answer{{ $quiz->id }}">
                            {{ $quiz->answer_a }}
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="answer{{ $quiz->id }}" id="answer{{ $quiz->id }}" value="b">
                        <label class="form-check-label" for="answer{{ $quiz->id }}">
                            {{ $quiz->answer_b }}
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="answer{{ $quiz->id }}" id="answer{{ $quiz->id }}" value="c">
                        <label class="form-check-label" for="answer{{ $quiz->id }}">
                            {{ $quiz->answer_c }}
                        </label>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary mt-3">Simpan Jawaban</button>
        </form>
    </div>
@endsection