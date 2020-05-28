<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cajero;
use Faker\Generator as Faker;

$factory->define(Cajero::class, function (Faker $faker) {
    return [
        'codigo'=> $faker->numberBetween($min = 1, $max = 99999) ,
        'direccion'=>$faker->text($maxNbChars = 50),
        'zona_id'=> $faker->numberBetween($min = 1, $max = 3) 
    ];
});
