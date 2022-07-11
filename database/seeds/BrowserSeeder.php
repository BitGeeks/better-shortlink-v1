<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrowserSeeder extends Seeder
{
    private $platforms = [
        'Chrome',
        'Safari',
        'Edge',
        'Opera',
    ];

    public function run()
    {
        DB::table('meta_browsers')->insert(
            array_map(function ($browser) {
                return [
                    'name' => $browser,
                    'icon' => 'browsers/' . Str::slug($browser)
                ];
            }, $this->platforms)
        );
    }
}
