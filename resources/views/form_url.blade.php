@extends('layouts.app')
@section('content')
    <p class="lead text-center">
        Данный пункт можно пропустить
    </p>
    <p class="text-center">
        Найдите картинку в Интернете в другом окне браузера,
        щелкните правой кнопкой мыши по картинке,
        выберите "Копировать&nbspадрес&nbspизображения", "Копировать&nbspURL&nbspкартинки";
        вернитесь в игру, нажмите Ctrl-V (вставить из буфера).
        Картинка должна быть публичной, разрешенной к размещению в Интернете;
        не&nbspдолжно быть изображений логотипов, названий известных торговых марок или Instagram-страниц.
    </p>
    <form action ="{{route('home.store_url')}}" method="POST" class="card card-body border-0" enctype=multipart/form-data>
        @csrf
        <input type="hidden" name="parent_id" value="{{$parent_id}}">
        <input type="hidden" name="type" value="{{$type}}">
        <input type="hidden" name="answer" value="{{$answer}}">
        <input type="hidden" name="question" value="{{$question}}">
        <div class="form-group">
            <label for="url" class="h5">Ссылка на картинку с изображением "{{$answer}}" в Интернете?
            </label>
            <input type="text"
                   name="url"
                   id="url"
                   class="form-control @error('url') is-invalid @enderror"
                   placeholder=""
                   value="{{old('url')}}">
            @error('url')
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
