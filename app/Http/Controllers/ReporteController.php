<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReporteRequest;
use App\Reporte;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException as Exc;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('desde') && $request->has('hasta') ) {
                $reportes =  Reporte::whereBetween('fecha',[$request->desde,$request->hasta])->with(['cajero:id,codigo,direccion','observacion:id,nombre'])->get();
            }else{
                $reportes =  Reporte::with(['cajero:id,codigo,direccion','observacion:id,nombre'])->get();
            }
            
            return response()->json([
                'rows'=>$reportes
            ]);
        }
        return redirect('/');
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

    public function PDF(Request $request)
    {
        if ($request->has('desde') && $request->has('hasta') && $request->desde != null && $request->hasta !=null) {
            
            $reportes =  Reporte::whereBetween('fecha',[$request->desde,$request->hasta])->with(['cajero:id,codigo,direccion','observacion:id,nombre'])->get();
        }else{
            $reportes =  Reporte::with(['cajero:id,codigo,direccion','observacion:id,nombre'])->get();
        }
        // return $reportes;
        // return $reportes;
        $pdf = \PDF::loadView('reportePDF',compact('reportes'));
        return $pdf->download('Reporte'.Carbon::now()->toDateString().'.pdf');
    }
}
