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
        'qualification' => json_encode([
            'name' => 1,
            'cat' => 1,
            'level' => [1],
        ]),
        'notes' => $faker->realText()
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Certificate::class, function (Faker\Generator $faker) {

    $c = DB::table('companies')->select('id')->get();
    $cn = DB::table('certificate_levels')->select('id')->get();
    return [
        'name' => $faker->userName,
        'gender' => true,
        'id_no' => random_int(1000,10000),
        'info' => $faker->realText(),
        'issue' => $faker->date(),
        'expiry' => $faker->date(),
        'dob' => $faker->date(),
        'renewal' => \Carbon\Carbon::now()->addMonth(random_int(1,5)),
        'status' => true,
        'certificate_level_id' => $cn->random()->id ?: 1,
        'company_id' => $c->random()->id ?: 1,
    ];
});