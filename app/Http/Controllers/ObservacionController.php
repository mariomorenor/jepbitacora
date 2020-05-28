<?php

namespace App\Http\Controllers;

use App\Cajero;
use App\Observacion;
use Illuminate\Http\Request;

class ObservacionController extends Controller
{

    public function index()
    {
        $reporte = Cajero::with(['zona','observacion'])->get();
        return $reporte;
    }

    public function store(Request $request)
    {
        $reporte = new Observacion;
        $reporte->fill($request->all());
        $reporte->save();
        return response(200);
    }

    public function destroy(Observacion $observacion)
    {
        $observacion->delete();
        return response(200);
    }
}
