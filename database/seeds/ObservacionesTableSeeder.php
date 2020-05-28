<?php

use App\Observacion;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ObservacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Observacion::create([
            'cajero_id'=>1,
            'descripcion'=>'Limpieza',
            'fecha'=>Carbon::now()->toDateString(),
            'marcacion_1'=>Carbon::now()->toTimeString(),
            'marcacion_2'=>Carbon::now()->toTimeString(),
        ]);
        Observacion::create([
            'cajero_id'=>2,
            'descripcion'=>'Arqueo',
            'fecha'=>Carbon::now()->toDateString(),
            'marcacion_1'=>Carbon::now()->toTimeString(),
            'marcacion_2'=>Carbon::now()->toTimeString(),
        ]);
        Observacion::create([
            'cajero_id'=>3,
            'descripcion'=>'no sé xD',
            'fecha'=>Carbon::now()->toDateString(),
            'marcacion_1'=>Carbon::now()->toTimeString(),
            'marcacion_2'=>Carbon::now()->toTimeString(),
        ]);
    }
}
