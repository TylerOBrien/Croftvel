<?php

use App\Models\User;

use Faker\Generator as Faker;

use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail
    ];
});
