<script type="text/javascript" src="{{ URL::asset('js/hideCardElements.js') }}"></script>

@extends('layouts.app')

@section('content')
    <form method="post" action="{{route('practise.store')}}">
        @csrf
        <input type="hidden" name="categoryId" value="{{$category->id}}">

        <div class="card mr-4 mb-4" style="width: 18rem;">
            <div class="card-body">
                <p class="card-text" id="card-english">{{ $card->english }}</p>
            <!--<p class="card-text" id="card-character">{{ $card->character }}</p>
            <p class="card-text" id="card-pinyin">{{ $card->pinyin }}</p>
            <p class="card-text" id="card-comment">{{ $card->comment }}</p>-->
                <button class="btn btn-primary" name="correct" value="1" type="submit">I know</button>
                <button class="btn btn-primary" name="correct" value="0" type="submit">Show full card</button>
            </div>
        </div>
    </form>
@endsection