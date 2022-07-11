<?php

use App\Enums\DeviceType;
use App\Models\Meta\Browser;
use App\Models\Meta\Device;
use App\Models\Meta\Platform;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Agent\Facades\Agent;

class SeedDefaultMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Desktop devices
        Device::insert(
            array_map(function ($device) {
                return [
                    'name' => $device,
                    'type' => DeviceType::desktop(),
                ];
            }, array_keys(Agent::getDesktopDevices()))
        );

        // Platforms
        Platform::insert(
            array_map(function ($device) {
                return [
                    'name' => $device,
                ];
            }, array_keys(Agent::getPlatforms()))
        );

        // Browsers
        Browser::insert(
            array_map(function ($device) {
                return [
                    'name' => $device,
                ];
            }, array_keys(Agent::getBrowsers()))
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Device::query()->delete();
        Platform::query()->delete();
        Browser::query()->delete();
    }
}
