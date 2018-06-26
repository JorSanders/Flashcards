@extends('layouts.app')

@section('content')
    <h2>Practise</h2>
    <p class="lead">Pick a category and start practising right away
        <a href="/categories/create">here</a>.
    </p>

    <div class="row">
        @foreach($categories as $category)
            <div class="card mr-4 mb-4" style="width: 18rem;">
                <div class="card-body">
                    <p class="float-right">Cards: {{ $category->cards()->count() }}</p>
                    <h5 class="card-title">{{ $category->title }}</h5>
                    <p class="card-text">{{ $category->description }}</p>
                </div>
                <div class="card-footer">
                    <a href="/practise/{{  $category->id }}" class="btn btn-success">Start</a>
                    <a href="/categories/{{  $category->id }}" class="btn btn-primary">View</a>
                    @if( Auth::check() && $category->user_id == Auth::user()->id)
                        <a href="/categories/{{  $category->id }}/edit" class="btn btn-warning">Edit</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection