@extends('layouts.app')
@section('content')
    <p class="lead text-center">
        @if ($url_exists)
            <img src="{{$url}}"
                 height="200" alt="{{$answer}}">
            <br>
            <br>
        @endif
        Данные сохранены.
    </p>
    <h3>
        &nbsp;Вопрос = <span class="text-danger">{{$question}}</span>?
    </h3>
    <h3>
        &nbsp;Ответ = <span class="text-danger">{{$answer}}</span>
    </h3>
    <div class="row">
        <div class="col-12 col-sm-12 text-center">
            <a href="/" class="btn btn-primary">Новая игра</a>
        </div>
    </div>
@endsection
