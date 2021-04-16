<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Approval;
use Faker\Generator as Faker;

$factory->define(Approval::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'events' => $faker->word,
        'reason' => $faker->text,
        'space_manager' => $faker->word,
        'total_people' => $faker->randomDigitNotNull,
        'location' => $faker->text,
        'location_requester' => $faker->word,
        'price' => $faker->word,
        'initial_date' => $faker->word,
        'initial_time' => $faker->word,
        'final_date' => $faker->word,
        'final_time' => $faker->word,
        'space' => $faker->word,
        'group_id' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'is_draft' => $faker->randomDigitNotNull,
        'is_repproved' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
