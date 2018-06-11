<?php

use Faker\Generator as Faker;

$factory->define(CodeHead\blogpost::class, function (Faker $faker) {
    return [
        'title'=>$faker->text(10),
        'body'=>$faker->text(190),
        'tag'=>$faker->text(5)
    ];
});
