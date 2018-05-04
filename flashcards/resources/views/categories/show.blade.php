<h2>{{ $category->title }}</h2>
<h4>{{ $category->description }}</h4>

@foreach($category->cards as $card)
    @foreach($card->contents as $content)
        <li>{{ $content->heading}}</li>
        <li>{{ $content->description }}</li>
        <br>
    @endforeach
@endforeach


