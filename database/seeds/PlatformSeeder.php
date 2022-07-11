<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlatformSeeder extends Seeder
{
    private $platforms = [
        'Windows',
        'macOS',
    ];

    public function run()
    {
        DB::table('meta_platforms')->insert(
            array_map(function ($platform) {
                return [
                    'name' => $platform,
                    'icon' => 'platforms/' . Str::slug($platform)
                ];
            }, $this->platforms)
        );
    }
}
