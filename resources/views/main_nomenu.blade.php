<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>판매관리</title>
    <link rel="stylesheet" href="{{ asset('my/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('my/css/my.css') }}">
    <script src="{{ asset('my/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('my/js/popper.js') }}"></script>
    <script src="{{ asset('my/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('my/js/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('my/js/bootstrap5-datetimepicker.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('my/css/bootstrap5-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('my/css/all.min.css') }}">
  </head>
  <body>
    <div class="container">

        @yield('content')

    </div>
  </body>
</html>