<?php

use App\Domain\FiscalNote\Model\FiscalNote;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(FiscalNote::class, function (Faker $faker) {
    return [
        'access_key' => Str::random(40),
        'xml' => $faker->text
    ];
});