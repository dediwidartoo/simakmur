<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Schedule::class, function (Faker $faker) {
    return [
        'nama_agenda'   => $faker->name,
        'tangggal'       => $faker->dateTime,
        'waktu'         => $faker->word,
        'lokasi'        => $faker->address,
        'catatan'       => $faker->realText,
    ];
});
