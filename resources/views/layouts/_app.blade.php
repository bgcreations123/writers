<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>{{ setting('site.title') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/custom.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/floating-wpp.js') }}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/floating-wpp.css') }}">

    </head>

    <body>
        <div id="app">
            @include('partials.nav')

            <main class="py-4">
                @yield('content')
            </main>
            
        </div>

        <!-- GetButton.io widget -->
        <!-- <script type="text/javascript">
            (function () {
                var options = {
                    facebook: "580097572666574", // Facebook page ID
                    whatsapp: "0726627161", // WhatsApp number
                    call_to_action: "Message us", // Call to action
                    button_color: "#FF6550", // Color of button
                    position: "right", // Position may be 'right' or 'left'
                    order: "facebook,whatsapp", // Order of buttons
                    pre_filled_message: "Message us", // WhatsApp pre-filled message
                };
                var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
                var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
                s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
                var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
            })();
        </script> -->
        <!-- /GetButton.io widget -->
        
        <!-- Whats App Button -->
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
    </body>

</html>
