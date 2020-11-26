<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\OrderDetail;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'orderid' => factory(App\Order::class),
        'menuid' => factory(App\VendorMenu::class),
        'qty' => $faker->randomNumber,
        'specialrequest' => $faker->paragraph
    ];
});
