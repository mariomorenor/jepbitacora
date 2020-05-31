<?php

namespace App\Http\Controllers;

use App\Cajero;
use App\Zona;
use Illuminate\Database\QueryException as Exc;
use Illuminate\Http\Request;

class CajeroController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
         
            if($request->sin_paginar){
                $cajeros = Cajero::all();
            }else{

                $cajeros = Cajero::with(['zona'])->paginate(4);
            }
            return $cajeros;
        }
        return redirect('/');
    }

    public function store(Request $request)
    {
        // return $request;
        try {
            $cajero = new Cajero;
            $cajero->fill($request->all());
            $cajero->save();
            return response(200);
        } catch (Exc $ex ) {
            
            return response($ex->getCode(),510);
    
        }
       
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
    
        return response(200);
    }

    public function destroy(Cajero $cajero)
    {   
        try {
             $cajero->delete();
            return response('',200);
        } catch (Exc $ex) {
            
            return response($ex,500);
        }
       
    }
}
