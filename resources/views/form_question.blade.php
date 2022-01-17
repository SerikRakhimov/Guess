@extends('layouts.app')
@section('content')
    <p class="lead text-center">
        Сформулируйте&nbsp;вопрос, ответ&nbsp;на&nbsp;который<br>
        <span class="text-primary">да</span>, если это <span class="text-primary">"{{$answer}}</span>"<br>
        <span class="text-info">нет</span>, если это <span class="text-info">"{{$parent_answer}}"</span>
    </p>
        <form action ="{{route('home.store_question')}}" method="POST" class="card card-body border-0" enctype=multipart/form-data>
            @csrf
            <input type="hidden" name="parent_id" value="{{$parent_id}}">
            <input type="hidden" name="type" value="{{$type}}">
            <input type="hidden" name="answer" value="{{$answer}}">
            <div class="form-group">
                <label for="question" class="h5">Вопрос?
                    </label>
                <input type="text"
                       name="question"
                       id="question"
                       class="form-control @error('question') is-invalid @enderror"
                       placeholder=""
                       value="{{old('question')}}">
                @error('question')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <br>

            <div class="row">
                <div class="col-1 col-sm-3">
                </div>
                <div class="col-5 col-sm-4">
                    <button class="btn btn-primary" type="submit">
                        Дальше
                    </button>
                </div>
                <div class="col-5 col-sm-2">
                    <button class="btn btn-success" type="button" onClick='location.href="/"'>
                        Отмена
                    </button>
                </div>
            </div>

        </form>

@endsection
