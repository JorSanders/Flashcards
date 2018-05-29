@extends('layouts.app')

@section('content')
    <h2>{{ $category->title }}</h2>
    <p class="lead">{{ $category->description }}</p>

    <div class="row">
        @foreach($category->cards as $card)
            <div class="card mr-4 mb-4" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $card->english }}</h5>
                    <p class="card-text">{{ $card->character }}</p>
                    <p class="card-text">{{ $card->pinyin }}</p>
                    <p class="card-text">{{ $card->comment }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
