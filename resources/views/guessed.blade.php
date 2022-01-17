@extends('layouts.app')

@section('content')
    <h3 class="text-center ">
        @if ($url_exists)
            <img src="{{$main->url}}"
                 height="200" alt="{{$main->answer}}">
            <br>
            <br>
        @endif
        <p class="class="text-success><mark>"Слово "{{$main->answer}}" угадано!</mark></p>
    </h3>
    <br>
    <div class="row">
        <div class="col-12 col-sm-12 text-center">
            <a href="/" class="btn btn-primary">Новая игра</a>
        </div>
    </div>
@endsection
