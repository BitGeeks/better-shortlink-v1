<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Domain;
use App\Models\Link;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'user_id' => $faker->boolean() ? optional(User::find(3))->id : null,
        'domain_id' => optional(Domain::inRandomOrder()->first())->id,
        'url' => $faker->url,
        'title' => $faker->boolean() ?: $faker->unique()->word(),
        'description' => $faker->boolean() ? $faker->text() : null,
        'password' => $faker->boolean() ? 'secret' : null,
        'expires_at' => $faker->boolean() ? ($faker->boolean() ? now()->addDays(rand(1, 7)) : now()->subDays(rand(1, 7))) : null
    ];
});
