@extends('layouts.app')
@section('content')
    <p class="lead text-center">
        @if ($url_exists)
            <img src="{{$url}}"
                 height="200" alt="{{$answer}}">
            <br>
            <br>
        @endif
        Сохранить в базе данных?
    </p>
    <h3>
        &nbsp;Вопрос = <span class="text-danger">{{$question}}</span>?
    </h3>
    <h3>
        &nbsp;Ответ = <span class="text-danger">{{$answer}}</span>
    </h3>
    <form action ="{{route('home.store_main')}}" method="POST" class="card card-body border-0" enctype=multipart/form-data>
        @csrf
        <input type="hidden" name="parent_id" value="{{$parent_id}}">
        <input type="hidden" name="type" value="{{$type}}">
        <input type="hidden" name="question" value="{{$question}}">
        <input type="hidden" name="answer" value="{{$answer}}">
        <input type="hidden" name="url" value="{{$url}}">

        <div class="row">
            <div class="col-1 col-sm-3">
            </div>
            <div class="col-5 col-sm-4">
                <button class="btn btn-primary" type="submit">
                    Сохранить
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
