@extends('layouts.app')

@section('content')
    <h2>Flashcards</h2>
    <p class="lead">This is a website I created to learn Chinese words. Please feel free to use it. </p><p> Note that I definitely am not a designer so excuse me for the basic look of the website.</p>
    <div class="card-deck   ">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Start now</h5>
                <p class="card-text">Practise chinese words</p>
            </div>
            <div class="card-footer">
                <a href="/practise" class="btn btn-primary">Begin</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add cards</h5>
                <p class="card-text">Create your own cards. You will need to sign up to prevent spam.</p>
            </div>
            <div class="card-footer">
                <a href="/categories/create" class="btn btn-primary">Add now</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Personalised learning</h5>
                <p class="card-text">Practise all the words YOU need to rehearse</p>
            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-primary">Coming soon</a>
            </div>
        </div>
    </div>
@endsection