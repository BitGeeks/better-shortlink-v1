<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Domain extends Model
{
    /** @var array $guarded */
    protected $guarded = ['id'];

    /*
     |--------------------------------------------------------------------------
     | Relationships
     |--------------------------------------------------------------------------
     */

    /**
     * Links on domain
     * 
     * @return HasMany|\Illuminate\Database\Eloquent\Collection|Link[]
     */
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    /**
     * Owner
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
     |--------------------------------------------------------------------------
     | Mutators
     |--------------------------------------------------------------------------
     */

    /**
     * Clean URL before saving
     * 
     * @param string $value 
     * @return void 
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] =  parse_url($value)['host'] ?? parse_url($value)['path'];
    }
}
