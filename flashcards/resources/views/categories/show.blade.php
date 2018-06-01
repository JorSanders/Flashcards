@extends('layouts.app')

@section('content')
    <h2>{{ $category->title }}</h2>
    <p class="lead">{{ $category->description }}</p>
    <a href="/practise/{{ $category->id }}" class="btn btn-primary">Practise</a>

    <div class="row mt-4">
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
