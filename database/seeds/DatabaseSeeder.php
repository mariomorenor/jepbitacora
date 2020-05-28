<?php

use App\Cajero;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ZonasTableSeeder::class);
        $this->call(CajerosTableSeeder::class);
        $this->call(ObservacionesTableSeeder::class);
        factory(Cajero::class,100)->create();
    }
}
