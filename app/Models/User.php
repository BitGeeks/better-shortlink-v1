<?php

namespace App\Models;

use Ankurk91\Eloquent\MorphToOne as EloquentMorphToOne;
use Ankurk91\Eloquent\Relations\MorphToOne;
use App\Models\Permission\Role;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasRoles,
        //HasPermissions,
        EloquentMorphToOne;

    /** @var array $guarded */
    protected $guarded = ['id'];

    /** @var string $guard_name */
    protected $guard_name = 'api';

    /** @var array $hidden */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** @var array $casts */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** @var array $casts */
    protected $appends = [
        'image_url',
    ];

    /** @var string DEFAULT_IMAGE */
    private const DEFAULT_IMAGE = 'https://api.adorable.io/avatars/285/{id}.png';

    /*
     |--------------------------------------------------------------------------
     | Relationships
     |--------------------------------------------------------------------------
     */

    /**
     * User's role
     *
     * @return \Ankurk91\Eloquent\Relations\MorphToOne 
     */
    public function role(): MorphToOne
    {
        return $this->morphToOne(
            Role::class,
            'model',
            config('permission.table_names.model_has_roles'),
            config('permission.column_names.model_morph_key'),
            'role_id'
        );
    }

    /**
     * User's domains
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 
     */
    public function domains(): HasMany
    {
        return $this->hasMany(Domain::class);
    }

    /**
     * User's links
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 
     */
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    /*
     |--------------------------------------------------------------------------
     | Accessors
     |--------------------------------------------------------------------------
     */

    public function getAccessAttribute(): array
    {
        return $this->getAllPermissions()
            ->pluck('name')->toArray();
    }

    /**
     * Get profile image
     * 
     * @return null|string 
     * @throws \RuntimeException 
     */
    public function getImageUrlAttribute(): ?string
    {
        if (strpos($this->image, '://') !== false) {
            return $this->image;
        }

        return $this->image
            ? Storage::url($this->image)
            : $this->getDefaultImage();
    }

    /*
     |--------------------------------------------------------------------------
     | Methods
     |--------------------------------------------------------------------------
     */

    public function getAbilities(): Collection
    {
        return $this->getAllPermissions()
            ->pluck('name');
    }

    /**
     * Get default dummy image
     * 
     * @return null|string 
     */
    public function getDefaultImage(): ?string
    {
        return str_replace('{id}', $this->id, static::DEFAULT_IMAGE);
    }

    /*
     |--------------------------------------------------------------------------
     | Mutators
     |--------------------------------------------------------------------------
     */

    /**
     * Assign hashed password value
     *
     * @param string $value Raw password value
     * @return void
     */
    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /*
     |--------------------------------------------------------------------------
     | JWT
     |--------------------------------------------------------------------------
     */

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
