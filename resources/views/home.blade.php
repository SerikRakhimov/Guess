@extends('layouts.app')

@section('content')
    <h3 class="text-center">
        Задумайте слово.
    </h3>
    <p class="text-center">Т.е. любое известное имя существительное; например: груша, тополь, лето и т.д..<br>
        Имена собственные недопустимы; например: Александр, Москва, Балхаш и т.д.</p>
    <h5 class="text-center">
        Отвечайте на вопросы про задуманное слово.
    </h5>

    <br>
    <p class="lead text-center">
        В базе данных {{$count}} слов.
    </p>

    <p class="lead text-center">
        <a href="mailto:s_astana@mail.ru">Автор программы - Рахимов С.Б., РК, г.Нур-Султан.</a>
    </p>
    <br>

    <div class="row">
        <div class="col-12 col-sm-12 text-center">
            @if ($main)
                <a href="/question/{{$main->id}}" class="btn btn-primary">Начать игру</a>
            @else
                База данных пуста!
            @endif
        </div>
    </div>
@endsection