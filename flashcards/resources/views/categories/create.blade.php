@extends('layouts.app')

@section('content')
    <h2>Create category</h2>
    <p class="lead">To automatically translate you need
        <a href="https://chrome.google.com/webstore/detail/allow-control-allow-origi/nlfbmbojpeacfghkpbjhddihlkkiljbi?hl=en-US">this</a>
        chrome extension</p>

    <form method="post" action="{{route('categories.store')}}">
        <div class="form-group">
            @csrf
            <label for="category-title mt-2">Title</label>
            <input placeholder="Enter title"
                   id="category-title"
                   class="form-control"
                   required
                   name="title"
            />
            <div class="form-group mt-2">
                <label for="description">Description</label>
                <textarea class="form-control"
                          name="description"
                          id="description"
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
            <input type="submit" value="create"/>
        </div>
    </form>
    <script type="text/javascript" src="{{ URL::asset('js/categoryCreate.js') }}"></script>
@endsection