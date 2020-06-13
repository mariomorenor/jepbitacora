<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Jep Bitacora</title>
    @php
    date_default_timezone_set ('America/Guayaquil');
    setlocale(LC_ALL,"es_ES");

  @endphp

  </head>
  <body>
    
    <div id="app">
        <main-app></main-app>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/reportes.js') }}"></script>
    </body>
</html>