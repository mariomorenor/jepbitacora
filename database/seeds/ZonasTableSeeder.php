<?php

use App\Zona;
use Illuminate\Database\Seeder;

class ZonasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Zona::create([
            'numero'=>1,
            'descripcion'=>'Santo Domingo'
        ]);
        Zona::create([
            'numero'=>2,
            'descripcion'=>'Una Zona'
        ]);
        Zona::create([
            'numero'=>3,
            'descripcion'=>'Otra Zona'
        ]);
    }
}
