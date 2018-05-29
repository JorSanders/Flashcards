@extends('layouts.app')

@section('content')
    <div class="card mr-4 mb-4" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{ $card->english }}</h5>
            <p class="card-text">{{ $card->character }}</p>
            <p class="card-text">{{ $card->pinyin }}</p>
            <p class="card-text">{{ $card->comment }}</p>
            <a href="/practise/{{  $category->id }}" class="btn btn-primary">Next</a>
        </div>
    </div>
@endsection