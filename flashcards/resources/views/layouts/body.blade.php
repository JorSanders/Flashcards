<main role="main" class="container">

    @if(Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message')}} </div>
        {{ Session::forget('message')}}
    @endif

    @yield('content')
</main>