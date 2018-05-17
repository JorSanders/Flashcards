<h2>{{ $category->title }}</h2>
<h4>{{ $category->description }}</h4>

@foreach($category->cards as $card)
    <h5>{{ $card->id }}</h5>
    <li>{{ $card->english }}</li>
    <li>{{ $card->pinyin }}</li>
    <li>{{ $card->character }}</li>
    <li>{{ $card->comment }}</li>
@endforeach


