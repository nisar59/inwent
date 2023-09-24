<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
      <head>
            @include('layouts.head')
      </head>
      <body class="account-page">
            @yield('content')
            @include('layouts.footer-js')
      </body>
</html>