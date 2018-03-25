<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{--<!-- CSRF Token -->--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Урюпинск онлайн</title>


        <!-- Bootstrap Core CSS -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto" rel="stylesheet">
        
        @stack('head_css')
        <!-- Custom CSS -->
        <link href="{{ mix('css/custom.css') }}" rel="stylesheet">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-2512175-9"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-2512175-9');
        </script>

        @stack('head_js')
    
        <!-- Font Awesome -->
        <script src="{{ asset('js/font-awesome.js') }}"></script>
        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body id="page-top" class="index">
    <div id="wrapper">
        @include('layouts.partials._navigation')
    
        @yield('content')
    
        @include('layouts.partials._footer')
    </div>
    @stack('footer_js')
    {{-- Load the application scripts --}}
    @if (app()->isLocal())
      <script src="{{ mix('js/app.js') }}"></script>
    @else
      <script src="{{ mix('js/manifest.js') }}"></script>
      <script src="{{ mix('js/vendor.js') }}"></script>
      <script src="{{ mix('js/app.js') }}"></script>
    @endif
        
    </body>
</html>