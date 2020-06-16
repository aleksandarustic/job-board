<?php

use Faker\Generator as Faker;
use App\Company as Company;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->email,
        'company' => $faker->randomElement(Company::pluck('id')->toArray())
    ];
});
