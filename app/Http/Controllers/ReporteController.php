<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReporteRequest;
use App\Reporte;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $reportes =  Reporte::with(['cajero:id,codigo,direccion','observacion:id,nombre'])->get();
            
            return response()->json([
                'rows'=>$reportes
            ]);
        }
        return  Reporte::with(['cajero:id,codigo,direccion','observacion:id,nombre'])->get();
    }

   
    public function store(ReporteRequest $request)
    {
        $nuevo_reporte = new Reporte;
        $nuevo_reporte->fill($request->all());
        $nuevo_reporte->marcacion_1 = Carbon::createFromTime($request->hora_1,$request->minuto_1);
        if ($request->has('hora_2') && $request->has('minuto_2') ) {
            $nuevo_reporte->marcacion_2 = Carbon::createFromTime($request->hora_2,$request->minuto_2);
        }
        $nuevo_reporte->save();
        return response('',200);
    }

    public function show($reporte_id)
    {  
    }

    public function destroy(Reporte $reporte)
    {
        //
    }
}
