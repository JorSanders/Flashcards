@foreach($cards as $card)
    <li><a href="/cards/{{  $card->id }}">{{ $card->id }}</a></li>
@endforeach
