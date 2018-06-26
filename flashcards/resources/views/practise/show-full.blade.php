@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('practise.store')}}">
        @csrf
        <input type="hidden" name="categoryId" value="{{$category->id}}">
        <input type="hidden" name="cardId" value="{{$card->id}}">

        <div class="card" style="height: 20em; width: 20em;">
            <div class="card-body">
                <h5 class="card-title">{{ $card->english }}</h5>
                <h5 class="card-title">{{ $card->character }}</h5>
                <h5 class="card-title">{{ $card->pinyin }}</h5>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" style="width: 49%" name="correct" value="1" type="submit">Correct</button>
                <button class="btn btn-danger" style="width: 49%" name="correct" value="0" type="submit">Wrong</button>
            </div>
        </div>
    </form>
@endsection