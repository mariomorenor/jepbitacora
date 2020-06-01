<?php

namespace App\Http\Controllers;

use App\Cajero;
use App\Observacion;
use Illuminate\Http\Request;

class ObservacionController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){
            $observaciones = Observacion::all();
            return $observaciones;
        }  
    }

    public function store(Request $request)
    {
        $reporte = new Observacion;
        $reporte->fill($request->all());
        $reporte->save();
        return response('',200);
    }

    public function destroy(Observacion $observacion)
    {
        $observacion->delete();
        return response(200);
    }
}
