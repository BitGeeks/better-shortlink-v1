<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Vinkla\Hashids\Facades\Hashids;

class Link extends Model
{
    /** @var array $guarded */
    protected $guarded = ['id'];

    /** @var array $hidden */
    protected $hidden = ['password'];

    /** @var array $casts */
    protected $casts = [
        'expires_at' => 'datetime',
        'is_disabled' => 'boolean',
    ];

    /** @var array $appends */
    protected $appends = [
        'is_protected',
        'is_expired',
        'hash',
        'full_url',
    ];

    /**
     * Performs actions after the model boots.
     *
     * @return void
     */
    public static function booted()
    {
        // Set creator ID
        static::creating(function (self $link) {
            $link->user_id = Auth::id();
        });
    }

    /*
     |--------------------------------------------------------------------------
     | Relationships
     |--------------------------------------------------------------------------
     */

    /**
     * 
     * @return BelongsTo|Domain
     */
    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    /**
     * 
     * @return HasMany|\Illuminate\Database\Eloquent\Collection|Tag[]
     */
    public function clicks(): HasMany
    {
        return $this->hasMany(Click::class);
    }

    /**
     * 
     * @return BelongsToMany|\Illuminate\Database\Eloquent\Collection|Tag[]
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /*
     |--------------------------------------------------------------------------
     | Accessors
     |--------------------------------------------------------------------------
     */

    /**
     * Get shortcode
     * 
     * @return string 
     */
    public function getHashAttribute(): string
    {
        return Hashids::connection(self::class)->encode($this->id);
    }

    /**
     * Determine if the link is expired
     * 
     * @return bool 
     */
    public function getIsExpiredAttribute(): bool
    {
        return !is_null($this->expires_at)
            && now()->gt($this->expires_at);
    }

    /**
     * Determine if the link is protected by password
     * 
     * @return bool 
     */
    public function getIsProtectedAttribute(): bool
    {
        return !is_null($this->password);
    }

    /**
     * Get shortcode url
     * 
     * @return string 
     */
    public function getFullUrlAttribute(): string
    {
        return 'http://' . $this->domain->name . '/' . $this->hash;
    }

    /*
     |--------------------------------------------------------------------------
     | Mutators
     |--------------------------------------------------------------------------
     */

    /**
     * Assign hashed password value
     *
     * @param string $value raw password value
     * @return void
     */
    public function setPasswordAttribute(?string $value): void
    {
        $this->attributes['password'] = $value ? Hash::make($value) : null;
    }

    /*
     |--------------------------------------------------------------------------
     | Methods
     |--------------------------------------------------------------------------
     */

    /**
     * Find link by shortcode
     * 
     * @param string $hash 
     * @return null|\App\Models\Link 
     */
    public static function getByHash(string $hash): ?Link
    {
        return Link::find(
            Hashids::connection(Link::class)->decode($hash)[0] ?? null
        );
    }
}
