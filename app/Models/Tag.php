<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    /** @var array $guarded */
    protected $guarded = ['id'];

    /*
     |--------------------------------------------------------------------------
     | Relationships
     |--------------------------------------------------------------------------
     */

    /**
     * Tagged links
     * 
     * @return BelongsToMany|\Illuminate\Database\Eloquent\Collection|Link[]
     */
    public function links(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
