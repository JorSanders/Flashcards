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

<form method="get">
    <button type="submit">I know</button>
    <button type="submit">Show full card</button>

    <input type="hidden" name="preference-english" value="{{ $preferences->english }}"/>
    <input type="hidden" name="preference-pinyin" value="{{ $preferences->pinyin }}"/>
    <input type="hidden" name="preference-character" value="{{ $preferences->character }}"/>
    <input type="hidden" name="preference-comment" value="{{ $preferences->comment }}"/>

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