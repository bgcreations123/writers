<nav class="navbar navbar-expand-md navbar-light navbar-laravel fixed-top">

    <div class="container">

        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            {{ menu('main_menu', 'layouts._nav') }}
        </div>

        <img class="d-inline-block align-top" src="{{ Voyager::image(setting('site.logo')) }}" style="width: 4%;">

        <div class="mx-auto order-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mx-auto" href="{{ url('/') }}">
                <span class="d-none d-block d-md-none">W{{ ltrim(setting('site.title'),'W') }}</span>
                <span class="d-none d-md-block">{{ ltrim(setting('site.title'),'W') }}</span>
            </a>
        </div>

        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">

            <ul class="navbar-nav ml-auto">
                {{-- <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Posts <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">post 1</a>
                    </div>
                </li> --}}

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
                        <a class="nav-link" href="{{ route('messages.inbox') }}">
                            <span class="fa fa-envelope-o"></span>
                            @if(!empty($message_count->count()))
                                <span class="badge badge-pill badge-primary">
                                    {{ $message_count->count() }}
                                </span>
                            @endif
                        </a>
                    </li>
                    @if(auth()->user()->hasRole('Client'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/shoppingcart') }}">
                                <span class="fa fa-shopping-cart"></span>
                                @if(Session::has('cart'))
                                    <span class="badge badge-pill badge-secondary">
                                        {{ Session::get('cart')->totalQty }}
                                    </span>
                                @endif
                            </a>

                        </li>
                    @elseif(auth()->user()->hasRole('Writer'))
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="fa fa-bell-o"></span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.profile', ['id'=>Auth::user()->id]) }}">My Profile</a>
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