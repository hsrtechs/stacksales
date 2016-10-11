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
/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Company::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->company,
        'internal_number' => $faker->unique()->randomNumber(6,true),
        'certification' => $faker->userName,
        'notes' => $faker->realText()
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Certificate::class, function (Faker\Generator $faker) {

    $cc = DB::table('certificate_categories')->select('id')->get();
    $c = DB::table('companies')->select('id')->get();

    return [
        'name' => $faker->userName,
        'internal_number' => $faker->unique()->randomNumber(6,true),
        'role' => $faker->userName,
        'info' => $faker->realText(),
        'issue' => $faker->date(),
        'expiry' => $faker->date(),
        'status' => 1,
        'certificate_categories_id' => $cc->random()->id ?: 1,
        'company_id' => $c->random()->id ?: 1,
    ];
});

$factory->define(App\CertificateCategory::class, function (Faker\Generator $faker) {

    $cc = DB::table('certificate_categories')->select('id');

    return [
        'name' => $faker->userName,
        'info' => $faker->realText(),
    ];
});
