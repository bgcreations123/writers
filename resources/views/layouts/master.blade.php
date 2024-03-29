<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title')
            @yield('title') - {{ config('app.name') }}
        @else 
            {{ config('app.name') }}
        @endif
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/floating-wpp.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/floating-wpp.css') }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ Voyager::image('settings/writers-fav.ico') }}" type="image/x-icon">
  

    <script>
        window.Laravel = @php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); @endphp
    </script>

</head>

<body>

    <div id="app">

        <div class="container">
            <div id="page">
                <div id="main">
                    {{-- @include('layouts._app') --}}
                    @include('layouts._navbar')
                    {{menu('main', 'layouts._navbar')}}
                    @include('layouts._messages')
                    @yield('content')
                </div>
            </div>

            {{-- Twark Codes --}}
            <!--Start of Tawk.to Script3-->
            <!-- <script type="text/javascript">
                var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/5a723626d7591465c707440f/default';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
                })();
            </script> -->
            <!--End of Tawk.to Script-->

            <!-- Whats App button -->
            <div id="whatsappButton"></div>


            <script type="text/javascript">
                $(function () {
                    $('#whatsappButton').floatingWhatsApp({
                        phone: '+254722547906',
                        popupMessage: 'Hello, how can we help you?',
                        message: "How can I make an order?",
                        showPopup: true,
                        showOnIE: false,
                        autoOpen: false, // true or false
                        autoOpenTimer: 4000, //In milliseconds
                        position: 'right',
                        headerTitle: 'Welcome!',
                        headerColor: 'green',
                        backgroundColor: 'green',
                        buttonImage: '<img src="{{ asset('images/whatsapp.svg') }}" />'
                    });
                });
            </script>

        </div>

        @include('layouts._footer')

    </div>
    
</body>
</html>