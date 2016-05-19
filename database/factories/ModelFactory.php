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
        'title'          => $faker->words(3, true),
        'description'    => $faker->paragraph,
        'event_time'     => $faker->words(3, true),
        'event_date'     => $faker->date(),
        'event_location' => $faker->city
    ];
});


$factory->define(\App\Writeups\Writeup::class, function (Faker\Generator $faker) {
    return [
        'title'          => $faker->words(3, true),
        'content'       => $faker->paragraphs(3, true),
        'link'           => $faker->url,
        'category'   => $faker->randomElement(['consultation', 'conservation', 'talks'])
    ];
});

$factory->define(\App\Affiliate::class, function (Faker\Generator $faker) {
    return [
        'name'          => $faker->words(3, true),
        'description'       => $faker->paragraph,
        'website'           => $faker->url,
    ];
});
