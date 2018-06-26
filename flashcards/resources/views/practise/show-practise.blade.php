<script type="text/javascript" src="{{ URL::asset('js/hideCardElements.js') }}"></script>

@extends('layouts.app')

@section('content')
    <div class="card" style="height: 20em; width: 20em;">
        <div class="card-body">
            <h5 class="card-title" style="display: block;" id="card-english">{{ $card->english }}</h5>
            <h5 class="card-title" style="display: none;" id="card-pinyin">{{ $card->pinyin }}</h5>
            <h5 class="card-title" style="display: none;" id="card-character">{{ $card->character }}</h5>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" onclick="$( '#preference-form' ).submit();" type="submit">Show the answer</button>
        </div>
    </div>
    <form method="post" style="display: none;" id="preference-form" action="{{route('practise.save')}}">
        @csrf
        <input type="hidden" id="preference-english" name="english" value="1">
        <input type="hidden" id="preference-pinyin" name="pinyin" value="0">
        <input type="hidden" id="preference-character" name="character" value="0">
        <input type="hidden" name="categoryId" value="{{ $category->id }}">
        <input type="hidden" name="cardId" value="{{ $card->id }}">
    </form>

    <button class="btn btn-secondary my-2" id="button-english"
            onclick="toggle('english')" type="submit">English: show
    </button>

    <button class="btn btn-secondary my-2" id="button-pinyin"
            onclick="toggle('pinyin')" type="submit">Pinyin: show
    </button>

    <button class="btn btn-secondary my-2" id="button-character"
            onclick="toggle('character')" type="submit">Character: show
    </button>

    @if (Cookie::get('english') === '0')
        <script> toggle('english'); </script>
    @endif

    @if (Cookie::get('pinyin') === '1')
        <script> toggle('pinyin'); </script>
    @endif

    @if (Cookie::get('character') === '1')
        <script> toggle('character'); </script>
    @endif

@endsection