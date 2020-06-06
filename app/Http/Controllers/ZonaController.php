<?php

namespace App\Http\Controllers;

use App\Zona;
use Illuminate\Http\Request;

class ZonaController extends Controller
{

    public function index(Request $request)
    {   
        $zona = Zona::all();
        if ($request->ajax()) {
            return response()->json([
                'rows'=>$zona
            ]);

        }
      
        return $zona;
    }

    public function store(Request $request)
    {
        
        $zona = new Zona;
        $zona->fill($request->all());
        $zona->save();
        return response(200);
       
    }

    public function show(Zona $zona)
    {
        return $zona;
    }

    public function update(Request $request, Zona $zona)
    {
        $zona->fill($request->all());
        $zona->save();
        return response(200);
    }

    public function destroy(Zona $zona)
    {
        $zona->delete();
        return response(200);
    }
}
