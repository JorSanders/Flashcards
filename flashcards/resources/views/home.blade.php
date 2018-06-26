@extends('layouts.app')

@section('content')
    <h2>Flashcards</h2>
    <p class="lead">This is a website I created to learn Chinese words. Please feel free to use it. </p>
    <p> Note that I definitely am not a designer so excuse me for the basic look of the website.</p>
    <div class="card-deck   ">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Learn chinese</h5>
                <p class="card-text">Pick a category and start practising right away</p>
            </div>
            <div class="card-footer">
                <a href="/practise" class="btn btn-primary">Begin</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add your own</h5>
                <p class="card-text">Create your own cards. Words can be automatically translated for you!
                    You will need to be logged in.</p>
            </div>
            <div class="card-footer">
                <a href="/categories/create" class="btn btn-primary">Add now</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Personalised practise</h5>
                <p class="card-text">Only practise those words you still don't know yet
                </p>
            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-secondary">I'm working on it!</a>
            </div>
        </div>
    </div>
@endsection