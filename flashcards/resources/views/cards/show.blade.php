{{ $card->id }}

@foreach($card->contents as $content)
    <li>{{ $content->heading}}</li>
    <li>{{ $content->description }}</li>
    <br>
@endforeach
