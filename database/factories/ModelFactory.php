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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->firstName,
        'excerpt' => $faker->paragraph,
        'author_id' => 1,
        'body' => $faker->paragraphs(1, true),
        'slug' => $faker->unique()->word,
        'meta_description' => $faker->paragraph(),
        'meta_keywords' => "asdf",
//        'status' => 'PUBLISHED',
        'featured' => 1,
        'created_at'=> \Carbon\Carbon::now()
    ];
});


$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'slug' => urlencode($name),
    ];
});
