@extends('layouts.app')

@section('content')
    @if ($main)
        <h3 class="text-center">
            @if ($url_exists)
                <img src="{{$main->url}}"
                     height="200" alt="{{$main->answer}}">
                <br>
                <br>
            @endif
            Вы задумали слово "{{$main->answer}}"?
        </h3>
        <br>

        <div class="row">
            <div class="col-12 col-sm-12 text-center">
                <a href="/answer_guessed/{{$main->id}}" class="btn btn-primary">Да</a>&emsp;

                @if ($id_calc != 0)
                    <a href="/question/{{$id_calc}}" class="btn btn-success">
                        @else
                            <a href="{{route('home.create_answer',['parent_id' => $main->id, 'type' => $type])}}" class="btn btn-success">
                                @endif
                                Нет
                            </a>
            </div>
        </div>

    @else
        <p class="lead text-center">
            Слово с id = {{$id}} не найдено!
        </p>
    @endif
@endsection
