@extends('layouts.app')
@section('content')
    <p class="lead text-center">
        Данные не сохранены!
    </p>
    <h3 class="text-center">
        {{$message}}
    </h3>
    <div class="row">
        <div class="col-12 col-sm-12 text-center">
            <a href="/" class="btn btn-primary">Новая игра</a>
        </div>
    </div>
@endsection