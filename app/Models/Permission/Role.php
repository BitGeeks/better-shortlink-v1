<?php

namespace App\Models\Permission;

use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    protected $appends = [
        'title',
    ];

    public function getTitleAttribute(): string
    {
        return ucfirst($this->name);
    }
}
