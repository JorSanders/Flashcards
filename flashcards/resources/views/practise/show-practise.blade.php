<script type="text/javascript" src="{{ URL::asset('js/hideCardElements.js') }}"></script>

<div id="card-english">
    {{ $card->english }}
</div>

<div id="card-pinyin">
    {{ $card->pinyin }}
</div>

<div id="card-character">
    {{ $card->character }}
</div>

<div id="card-comment">
    {{ $card->comment }}
</div>

<form method="post" action="{{route('practise.store')}}">
    @csrf
    <button name="correct" value="1" type="submit">I know</button>
    <button name="correct" value="0" type="submit">Show full card</button>

    <input type="hidden" name="cardId" value="{{ $card->id }}">
    <input type="hidden" name="categoryId" value="{{ $category->id }}">

    <input type="hidden" name="preferenceEnglish" id="preference-english" value="{{ $preferences->english }}"/>
    <input type="hidden" name="preferencePinyin" id="preference-pinyin" value="{{ $preferences->pinyin }}"/>
    <input type="hidden" name="preferenceCharacter" id="preference-character" value="{{ $preferences->character }}"/>
    <input type="hidden" name="preferenceComment" id="preference-comment" value="{{ $preferences->comment }}"/>

    <button type="button" onclick="toggle('english')">english</button>
    <button type="button" onclick="toggle('pinyin')">pinyin</button>
    <button type="button" onclick="toggle('character')">character</button>
    <button type="button" onclick="toggle('comment')">comment</button>
</form>

<script type="text/javascript">

    @foreach ($preferences as $key=>$preference)
    if ({{$preference}} === 0) {
        document.getElementById("card-" + "{{ $key }}").style.display = "none";
        ;
    }
    @endforeach

</script>