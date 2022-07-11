<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Click;
use App\Models\Link;
use App\Models\Meta\Browser;
use App\Models\Meta\Country;
use App\Models\Meta\Device;
use App\Models\Meta\Platform;
use Faker\Generator as Faker;

$factory->define(Click::class, function (Faker $faker) {
    return [
        'platform_id' => optional(Platform::inRandomOrder()->first())->id,
        'browser_id' => optional(Browser::inRandomOrder()->first())->id,
        'device_id' => optional(Device::inRandomOrder()->first())->id,
        'link_id' => optional(Link::inRandomOrder()->first())->id,
        'country_code' => optional(Country::inRandomOrder()->first())->code,
        'session_id' => $faker->unique()->uuid,
        'ip' => $faker->unique()->ipv4,
        'geo' => [
            'city' => null,
        ],
        'created_at' => $faker->boolean() ? now()->subDays(rand(0, 14)) : now()->addDays(rand(0, 14)),
    ];
});
