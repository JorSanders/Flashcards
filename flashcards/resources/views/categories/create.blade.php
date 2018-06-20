@extends('layouts.app')

@section('content')
    <h2>{{ isset($category)? "Edit " . $category->title : "Create category" }}</h2>
    <p class="lead">To automatically translate you need
        <a href="https://chrome.google.com/webstore/detail/allow-control-allow-origi/nlfbmbojpeacfghkpbjhddihlkkiljbi?hl=en-US">this</a>
        chrome extension</p>

    <form method="post"
          action="{{ isset($category)? route('categories.update', [$category->id]) : route('categories.store')}}">
        <div class="form-group">
            @csrf
            <label for="category mt-2">Title</label>
            <input placeholder="Enter title"
                   id="title"
                   class="form-control"
                   value="{{ $category->title or null }}"
                   required
                   name="title"
            />
            <div class="form-group mt-2">
                <label for="description">Description</label>
                <textarea class="form-control"
                          name="description"
                          id="description"
                          value="{{ $category->description or null }}"
                          rows="3"
                          placeholder="Enter description"
                ></textarea>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">English</th>
                    <th scope="col">Character</th>
                    <th scope="col">Pinyin</th>
                </tr>
                </thead>
                <tbody id="cards">
                </tbody>
            </table>
            <input type="submit" class="btn-primary" value="save"/>
            @if(isset($category))
                @method('PUT')
            @endif
        </div>
    </form>
    <script>
        cards = [];
        @if(isset($category))
            var cards = {!! $category->cards->toJson() !!};
        @endif
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/categoryCreate.js') }}"></script>
@endsection