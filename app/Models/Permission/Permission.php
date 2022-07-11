<?php

namespace App\Models\Permission;

use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    protected $appends = [
        'title',
    ];

    public function getTitleAttribute(): string
    {
        return ucfirst(
            implode(
                ' ',
                explode('-', $this->name)
            )
        );
    }
}
