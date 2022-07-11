<?php

namespace App\Models\Meta;

use App\Models\Click;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platform extends Model
{
    /** @var array $table */
    protected $table = 'meta_platforms';

    /** @var array $guarded */
    protected $guarded = ['id'];

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
}
