<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => Hash::make('password'),
        'type' => $faker->randomElement(['top','mid']),
        'photo'=> $faker->image('public/images',640,480, null, false),       
        'role_id'=>$faker->numberBetween(1,8),
        'created_at'=>$faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'updated_at'=>$faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
    ];
});
