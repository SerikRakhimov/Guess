@extends('layouts.app')
@section('content')
    <p class="lead text-center">
        Вопросы закончились
    </p>
    <form action ="{{route('home.store_answer')}}" method="POST" class="card card-body border-0" enctype=multipart/form-data>
        @csrf
        <input type="hidden" name="parent_id" value="{{$parent_id}}">
        <input type="hidden" name="type" value="{{$type}}">
        <div class="form-group">
            <label for="answer" class="h5">Какое слово вы загадали?</label>
            <input type="text"
                   name="answer"
                   id="answer"
                   class="form-control @error('answer') is-invalid @enderror"
                   placeholder=""
                   value="{{old('answer')}}">
            @error('answer')
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