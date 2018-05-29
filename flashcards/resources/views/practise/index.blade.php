@extends('layouts.app')

@section('content')
    <h2>Choose a category</h2>

    <div class="row">
        @foreach($categories as $category)
            <div class="card mr-4 mb-4" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->title }}</h5>
                    <p class="card-text">{{ $category->description }}</p>
                    <a href="/practise/{{  $category->id }}" class="btn btn-primary">Start</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection