<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Jep Bitacora</title>

    @php
    date_default_timezone_set ('America/Guayaquil');
    setlocale(LC_ALL,"es_ES.utf8");
    // \Carbon\Carbon::locale('es');
     
    // echo \Carbon\Carbon::getLocale();

  @endphp
  </head>
  <body>

         
          
                    <table class="table table-hover table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Código</th>
                                <th>Dirección</th>
                                <th>Marcación_1</th>
                                <th>Marcación_2</th>
                                <th>Fecha</th>
                                <th>Observación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                            @endphp
                            @foreach ($reportes as $reporte)
                                <tr>
                                    <td>{{$reporte->cajero->codigo}}</td>
                                    <td>{{$reporte->cajero->direccion}}</td>
                                    <td>{{$reporte->marcacion_1}}</td>
                                    <td>{{$reporte->marcacion_2}}</td>
                                    @php
                                        $fecha = \Carbon\Carbon::parse($reporte->fecha)
                                    @endphp
                                    <td>{{$fecha->day.' de '.$meses[date($fecha->month)-1].' del '. $fecha->year}}</td>
                                    <td>{{$reporte->observacion->nombre}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
           
         
   

    
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>