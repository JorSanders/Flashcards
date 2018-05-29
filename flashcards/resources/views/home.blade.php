@extends('layouts.app')

@section('content')
    <h2>Flashcards</h2>
    <p class="lead">This is a website to practise chinese words. English to Chinese and other way around. Characters and/or pinyin.</p>
    <div class="row">
        <div class="col-sm-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Practise chinese</h5>
                    <p class="card-text">Practise chinese with flashcards</p>
                    <a href="/practise" class="btn btn-primary">Begin</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add cards</h5>
                    <p class="card-text">Create a new category and add</p>
                    <a href="/categories/create" class="btn btn-primary">Add now</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage cards</h5>
                    <p class="card-text">Manage your cards</p>
                    <a href="/categories/" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>
    </div>
@endsection