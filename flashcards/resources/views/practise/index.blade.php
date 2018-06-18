@extends('layouts.app')

@section('content')
    <h2>Choose a category</h2>
    <p class="lead">Create your own cards to practise
        <a href="/categories/create">here</a>.
    </p>

    <div class="row">
        @foreach($categories as $category)
            <div class="card mr-4 mb-4" style="width: 18rem;">
                <div class="card-body">
                    <p class="float-right">Cards: {{ $category->cards()->count() }}</p>
                    <h5 class="card-title">{{ $category->title }}</h5>
                    <p class="card-text">{{ $category->description }}</p>
                    <a href="/practise/{{  $category->id }}" class="btn btn-primary">Start</a>
                    <a href="/categories/{{  $category->id }}" class="btn btn-primary">View cards</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection