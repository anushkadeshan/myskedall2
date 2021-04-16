<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {

    return [
        'idModerador' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'description' => $faker->text,
        'address' => $faker->word,
        'schedules' => $faker->word,
        'phone' => $faker->word,
        'facebook' => $faker->word,
        'site' => $faker->word,
        'mapa' => $faker->text,
        'app_posts' => $faker->word,
        'app_finance' => $faker->word,
        'app_approvals' => $faker->word,
        'app_tasks' => $faker->word,
        'app_statistics' => $faker->word,
        'app_researches' => $faker->word,
        'app_degination' => $faker->word,
        'app_devontial' => $faker->word,
        'app_tip' => $faker->word,
        'app_bible' => $faker->word,
        'app_el_church' => $faker->word,
        'app_space' => $faker->word,
        'url_el_church' => $faker->word,
        'app_store' => $faker->word,
        'url_shop' => $faker->word,
        'label_media' => $faker->word,
        'description_media' => $faker->word,
        'label_calendar' => $faker->word,
        'description_calendar' => $faker->word,
        'label_download' => $faker->word,
        'description_download' => $faker->word,
        'label_application' => $faker->word,
        'label_comunication' => $faker->word,
        'contact_us' => $faker->word,
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
