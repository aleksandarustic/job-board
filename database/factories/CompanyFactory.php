<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {

    $filepath = storage_path('app/public');

    return [
        'name' => $faker->company,
        'email' => $faker->unique()->companyEmail,
        'website' => $faker->domainName,
        'logo' => $faker->image($filepath,150, 150,'technics',false,false)
    ];
});
