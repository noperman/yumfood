<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\VendorMenu;
use Faker\Generator as Faker;

$factory->define(VendorMenu::class, function (Faker $faker) {
    return [
        'vendorid' => factory(App\Vendor::class),
        'name' => $faker->company,
        'description' => $faker->paragraph,
        'prices' => $faker->randomElement(['150000', '50000', '250000', '100000', '300000']),
        'status' => $faker->boolean()
    ];
});
