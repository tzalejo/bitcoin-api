<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        //
        'dni'     => $faker->randomNumber(8, false),
        'nombre'  => $faker->firstNameMale,
        'apellido'=> $faker->lastName,
        'telefono'=> $faker->phoneNumber,
        'email'   => $faker->email
    ];
});
