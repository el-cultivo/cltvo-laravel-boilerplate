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
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    return [
        'name'              => App\User::createUniqueUsername($firstName,$lastName),
        'first_name'        => $firstName,
        'last_name'         => $lastName,
        'email'             => $faker->unique()->email,
        'password'          => bcrypt(str_random(10)),
        'remember_token'    => str_random(10),
        'active'            => mt_rand(1, 10000) <= 1/10 * 10000 //rand(1,10) <= 1 ? 0 : 1
    ];
});
