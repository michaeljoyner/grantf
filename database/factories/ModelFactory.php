<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Blog\Post::class, function (Faker\Generator $faker) {
    return [
        'title'        => $faker->sentence,
        'description'  => $faker->paragraph,
        'body'         => $faker->paragraphs(5, true),
        'published'    => 0,
        'published_at' => $faker->date()
    ];
});

$factory->define(\App\Occasions\Event::class, function (Faker\Generator $faker) {
    return [
        'title'          => $faker->sentence,
        'description'    => $faker->paragraph,
        'event_time'     => $faker->sentence,
        'event_date'     => $faker->date(),
        'event_location' => $faker->city
    ];
});
