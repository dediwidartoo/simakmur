<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

$factory->define(App\Models\Artikel::class, function (Faker $faker) {
    $word = $faker->word;
    return [
        'judul' => Str::slug($faker->unique()->name, '-'),
        'gambar' => $faker->unique()->name,
        'body'=> $word,
        // 'kategori_id' => function()
        // {
        //     return Category::all()->random();
        // }
        'kategori_id' => $faker->randomDigit(),
    ];
});
