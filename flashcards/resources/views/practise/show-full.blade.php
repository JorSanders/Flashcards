@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('practise.store')}}">
        @csrf
        <input type="hidden" name="categoryId" value="{{$category->id}}">

        <div class="card mr-4 mb-4" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $card->english }}</h5>
                <p class="card-text">{{ $card->character }}</p>
                <p class="card-text">{{ $card->pinyin }}</p>
                <p class="card-text">{{ $card->comment }}</p>
                <button class="btn btn-success" name="correct" value="1" type="submit">Correct</button>
                <button class="btn btn-danger" name="correct" value="0" type="submit">Wrong</button>
            </div>
        </div>
    </form>
@endsection