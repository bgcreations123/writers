<nav class="navbar navbar-expand-md navbar-light navbar-laravel fixed-top">

    <div class="container" style="padding-bottom: 10px;">
        
        <img src="{{ Voyager::image(setting('site.logo')) }}" style="width: 7%; position: fixed;">

        <a class="navbar-brand" href="{{ url('/') }}" style="position: fixed; padding: 35px 0 0 47px;">
            {{ ltrim(setting('site.title'),'W') }}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/home">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Our Services</a>
                    </li>

                    @if(auth()->user()->hasRole('Client'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/shoppingcart') }}">
                                Cart
                                <span class="badge badge-pill badge-secondary">
                                    {{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}
                                </span>
                            </a>

                        </li>
                    @elseif(auth()->user()->hasRole('Writer'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('writer.payments') }}">Payments</a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
                            <div class="dropdown-divider"></div>
                            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('Editor'))
                                <a class="dropdown-item" href="{{ URL::to('/admin') }}">Back Office</a>
                                <div class="dropdown-divider"></div>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    
                @endguest
            </ul>
        </div>

    </div>

</nav>