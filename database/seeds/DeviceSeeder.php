<?php

use App\Enums\DeviceType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DeviceSeeder extends Seeder
{
    public function run()
    {
        $devices = [
            [
                'name' => 'iPhone',
                'type' => DeviceType::phone()
            ],
            [
                'name' => 'iPad',
                'type' => DeviceType::tablet()
            ],
            [
                'name' => 'MacBook Pro',
                'type' => DeviceType::desktop()
            ],
            [
                'name' => 'Google',
                'type' => DeviceType::robot()
            ],
        ];

        DB::table('meta_devices')->insert($devices);
    }
}
