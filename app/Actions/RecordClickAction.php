<?php

namespace App\Actions;

use App\Enums\DeviceType;
use App\Models\Link;
use App\Models\Meta\Browser;
use App\Models\Meta\Device;
use App\Models\Meta\Platform;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;
use Torann\GeoIP\Facades\GeoIP;

class RecordClickAction
{
    public function execute(Request $request, Link $link)
    {
        $link->clicks()->create([
            'session_id' => $request->session()->getId(),
            'device_id' => $this->getDevice()->id,
            'platform_id' => $this->getPlatform()->id,
            'browser_id' => $this->getBrowser()->id,
            'country_code' => GeoIP::getLocation()->iso_code,
            'ip' => $request->ip(),
            'geo' => GeoIP::getLocation()->toArray(),
        ]);
    }

    public function getDevice()
    {
        if (Agent::isTablet()) {
            $type = DeviceType::tablet();
        }

        if (Agent::isDesktop()) {
            $type = DeviceType::desktop();
        }

        if (Agent::isPhone()) {
            $type = DeviceType::phone();
        }

        if (Agent::isRobot()) {
            $type = DeviceType::robot();
        }

        return Device::firstOrCreate(
            [
                'name' => Agent::device(),
            ],
            [
                'type' => $type,
            ]
        );
    }

    public function getPlatform()
    {
        return Platform::firstOrCreate([
            'name' => Agent::platform(),
        ]);
    }

    public function getBrowser()
    {
        return Browser::firstOrCreate([
            'name' => Agent::browser(),
        ]);
    }
}
