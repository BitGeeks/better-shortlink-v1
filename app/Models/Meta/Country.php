<?php

namespace App\Models\Meta;

use App\Models\Click;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    /** @var array $guarded */
    protected $guarded = [];

    /** @var bool $incrementing */
    public $incrementing = false;

    /** @var string $primaryKey */
    protected $primaryKey = 'code';

    /** @var string */
    protected $table = 'meta_countries';

    /** @var bool $timestamps */
    public $timestamps = false;

    /*
     |--------------------------------------------------------------------------
     | Relationships
     |--------------------------------------------------------------------------
     */

    /**
     * Related clicks
     * 
     * @return HasMany|\Illuminate\Database\Eloquent\Collection|Click[]
     */
    public function clicks(): HasMany
    {
        return $this->hasMany(Click::class);
    }

    /*
     |--------------------------------------------------------------------------
     | Override defaults
     |--------------------------------------------------------------------------
     */

    public function getForeignKey()
    {
        return 'country_code';
    }
}
