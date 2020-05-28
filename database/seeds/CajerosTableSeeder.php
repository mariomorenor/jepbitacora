<?php

use App\Cajero;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CajerosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Cajero::create([
            'codigo'=>345356,
            'direccion'=>'Ciudad Nueva sector 5 calle...',
            'zona_id'=>1,
        ]);

        Cajero::create([
            'codigo'=>46366,
            'direccion'=>'Otra direccion',
            'zona_id'=>3,
        ]);

        Cajero::create([
            'codigo'=>75787,
            'direccion'=>'Calle Juan',
            'zona_id'=>2,
        ]);

        Cajero::create([
            'codigo'=>86456,
            'direccion'=>'Av. 29 de Mayo',
            'zona_id'=>1,
        ]);

        Cajero::create([
            'codigo'=>78636,
            'direccion'=>'No se alguna otra direccion',
            'zona_id'=>2,
        ]);
    }
}
