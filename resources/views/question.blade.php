@extends('layouts.app')

@section('content')
    @if ($main)
        <h3 class="text-center">
            {{$main->question}}?
        </h3>
        <br>

        <div class="row">
            <div class="col-12 col-sm-12 text-center">
                <a href="/answer/{{$main->id}}/1/{{$main->yes_id}}" class="btn btn-primary">Да</a>&emsp;

            @if ($main->no_id != 0)
                 <a href="/question/{{$main->no_id}}" class="btn btn-success">
            @else
                <a href="{{route('home.create_answer',['parent_id' => $main->id, 'type' => 2])}}" class="btn btn-success">
            @endif
                 Нет
                 </a>&emsp;

                <a href="/answer/{{$main->id}}/3/{{$main->notknow_id}}" class="btn btn-warning">Не знаю</a>

            </div>
         </div>

    @else

        <p class="lead text-center">
            Вопрос с id = {{$id}} не найден!
        </p>

    @endif
@endsection