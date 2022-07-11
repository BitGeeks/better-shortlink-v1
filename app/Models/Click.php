<?php

namespace App\Models;

use App\Models\Meta\Browser;
use App\Models\Meta\Country;
use App\Models\Meta\Device;
use App\Models\Meta\Platform;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Click extends Model
{
    /** @var array $guarded */
    protected $guarded = ['id'];

    /** @var array $casts */
    protected $casts = [
        'geo' => 'object',
    ];

    /*
     |--------------------------------------------------------------------------
     | Relationships
     |--------------------------------------------------------------------------
     */

    /**
     * Related link
     * 
     * @return BelongsTo|Link
     */
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }

    /**
     * Related country
     * 
     * @return BelongsTo|Country
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_code');
    }

    /**
     * Related device
     * 
     * @return BelongsTo|Device
     */
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * Related platform
     * 
     * @return BelongsTo|Platform
     */
    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }

    /**
     * Related browser
     * 
     * @return BelongsTo|Browser
     */
    public function browser(): BelongsTo
    {
        return $this->belongsTo(Browser::class);
    }
}
