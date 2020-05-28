<?php

namespace App\Http\Controllers;

use App\Cajero;
use App\Zona;
use Illuminate\Http\Request;

class CajeroController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cajeros = Cajero::with(['zona'])->paginate(4);
            return $cajeros;
        }
        return redirect('/');
    }

    public function store(Request $request)
    {
        $cajero = new Cajero;
        $cajero->fill($request->all());
        $cajero->save();
        return response(200);
    }

    public function show(Cajero $cajero)
    {
        $zona = $cajero->zona;
        return response()->json([
            'cajero'=>$cajero,
            'zona'=>$zona
        ]);
    }

    public function update(Request $request, Cajero $cajero)
    {
        // return $request;
        $cajero->fill($request->all());
        $cajero->save();
        return $cajero;
        return response(200);
    }

    public function destroy(Cajero $cajero)
    {   
        return $cajero;
        // $cajero->delete();
        // return response(200);
    }
}
