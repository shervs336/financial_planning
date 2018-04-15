<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Financial Planning') }}</title>

    <!-- Styles -->
    <link href="{{ asset('startbootstrap/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('startbootstrap/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('startbootstrap/css/sb-admin.min.css') }}" rel="stylesheet">
</head>
<body class="fixed-nav sticky-footer" id="page-top">
      @if(!Request::is('login') && !Request::is('register'))
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
          <a class="navbar-brand" href="index.html">{{ config('app.name', 'Financial Planning') }}</a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">

            @include('layouts.sidenav')

            @include('layouts.topnav')
          </div>
        </nav>
        @endif

        <main class="@if(!Request::is('login') && !Request::is('register')) content-wrapper @endif">
          <div class="container">
            @yield('content')
          </div>
        </main>

    <script src="{{ asset('startbootstrap/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('startbootstrap/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('startbootstrap/js/sb-admin.min.js') }}"></script>

    <script type="text/javascript">
    var csrfToken = $('[name="csrf_token"]').attr('content');
    var token = $('[name="_token"]');

    setInterval(refreshToken, 300000); // 1 hour

    function refreshToken(){
        $.get("{{ route('refresh-csrf') }}").done(function(data){
            csrfToken = data; // the new token
            token.val(data);
        });
    }
    </script>
</body>
</html>
