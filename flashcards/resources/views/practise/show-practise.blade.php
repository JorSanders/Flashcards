<script type="text/javascript" src="{{ URL::asset('js/hideCardElements.js') }}"></script>

@extends('layouts.app')

@section('content')
    <div class="card mr-4 mb-4" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title" style="display: block" id="card-english">{{ $card->english }}</h5>
            <h5 class="card-title" style="display: none" id="card-pinyin">{{ $card->pinyin }}</h5>
            <h5 class="card-title" style="display: none" id="card-character">{{ $card->character }}</h5>
            <h5 class="card-title" style="display: none" style="display: none"
                id="card-comment">{{ $card->comment }}</h5>
            <form method="post" action="{{route('practise.save')}}">
                @csrf
                <input type="hidden" id="preference-english" name="english" value="1">
                <input type="hidden" id="preference-pinyin" name="pinyin" value="0">
                <input type="hidden" id="preference-character" name="character" value="0">
                <input type="hidden" id="preference-comment" name="comment" value="0">
                <input type="hidden" name="categoryId" value="{{ $category->id }}">
                <input type="hidden" name="cardId" value="{{ $card->id }}">
                <button class="btn btn-primary" type="submit">Show</button>
            </form>
        </div>
    </div>

    <button class="btn btn-success my-2" id="button-english"
            onclick="toggle('english')" type="submit">English: show
    </button>

    <button class="btn btn-danger my-2" id="button-pinyin"
            onclick="toggle('pinyin')" type="submit">Pinyin: show
    </button>

    <button class="btn btn-danger my-2" id="button-character"
            onclick="toggle('character')" type="submit">Character: show
    </button>

    <!--
    <button class="btn btn-danger my-2" id="button-comment"
            onclick="toggle('comment')" type="submit">Comment: show
    </button>
    -->

    @if (Cookie::get('english') === '0')
        <script> toggle('english'); </script>
    @endif

    @if (Cookie::get('pinyin') === '1')
        <script> toggle('pinyin'); </script>
    @endif

    @if (Cookie::get('character') === '1')
        <script> toggle('character'); </script>
    @endif

    @if (Cookie::get('comment') === '1')
        <script> toggle('comment'); </script>
    @endif

@endsection