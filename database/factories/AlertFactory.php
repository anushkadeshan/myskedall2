<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Alert;
use Faker\Generator as Faker;

$factory->define(Alert::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'model_id' => $faker->randomDigitNotNull,
        'event_name' => $faker->word,
        'group_id' => $faker->randomDigitNotNull,
        'routine' => $faker->word,
        'is_read' => $faker->word,
        'url' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'updated_by' => $faker->randomDigitNotNull,
        'deleted_by' => $faker->randomDigitNotNull
    ];
});
