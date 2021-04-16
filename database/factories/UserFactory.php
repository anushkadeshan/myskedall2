<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {

    return [
        'primary_group_id' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'nickname' => $faker->word,
        'email' => $faker->word,
        'email_verified_at' => $faker->date('Y-m-d H:i:s'),
        'password' => $faker->word,
        'sex' => $faker->word,
        'birth' => $faker->word,
        'phone' => $faker->word,
        'address' => $faker->word,
        'zipcode' => $faker->word,
        'neighborhood' => $faker->word,
        'city' => $faker->word,
        'uf' => $faker->word,
        'profession' => $faker->word,
        'rg' => $faker->word,
        'cpf' => $faker->word,
        'level' => $faker->word,
        'status' => $faker->word,
        'have_warning' => $faker->word,
        'have_group_warning' => $faker->word,
        'created_at_ip' => $faker->word,
        'last_logging_ip' => $faker->word,
        'inclusion_date' => $faker->word,
        'last_logging_at' => $faker->word,
        'remember_token' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
