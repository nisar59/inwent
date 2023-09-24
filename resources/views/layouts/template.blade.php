<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
      <head>
      @include('layouts.head')
      </head>
  <body>
<!-- Main Wrapper -->
<div class="main-wrapper">
      <!-- Header -->
      @include('layouts.header')
      <!-- /Header -->
      <!-- Sidebar -->
      @include('layouts.sidebar')
      <!-- /Sidebar -->
      @yield('content')
</div>


@yield('mdl')

<div id="mdl"></div>

@include('layouts.footer-js')
<script type="text/javascript">
@if (count($errors) > 0)
      @foreach ($errors->all() as $error)
            error("{{$error}}", 'Input error');
      @endforeach
@elseif (Session::has('warning'))
      warning("{{ Session::get('warning') }}");
@elseif (Session::has('success'))
      success("{{ Session::get('success') }}");
@elseif (Session::has('error'))
      error("{{ Session::get('error') }}");
@elseif (Session::has('info'))
      info(`{{ Session::get('info') }}`);
@elseif (isset($warning))
      warning("{{ $warning }}");
@elseif (isset($success))
      success("{{ $success }}");
@elseif (isset($error))
      error("{{ $error }}");
@elseif (isset($info))
      info("{{ $info }}");
@else
@endif
</script>
</body>
</html>