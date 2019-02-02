<?php

use Faker\Generator as Faker;
use App\User;
$factory->define(App\Model\Like::class, function (Faker $faker) {
    return [
        'User_id' => function(){
            return User::all()->random();
        },
    ];
});
