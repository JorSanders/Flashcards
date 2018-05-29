<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5" id="navbar">
    <a class="navbar-brand" href="#">Logo</a>

    <!-- hamburger button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active px-2">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item px-2" >
                <a class="nav-link" href="/practise"> Practise</a>
            </li>
            <li class="nav-item px-2" >
                <a class="nav-link" href="/categories"> Categories</a>
            </li>
            @guest
                <li class="nav-item px-2"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li class="nav-item px-2"><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li class="nav-item disabled px-2">
                    <span class="navbar-text">
                        {{ Auth::user()->name }}
                    </span>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>

