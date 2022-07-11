<?php

namespace App\Providers;

use App\Models\Domain;
use App\Models\Link;
use App\Models\Permission\Permission;
use App\Models\Permission\Role;
use App\Models\User;
use App\Policies\DomainPolicy;
use App\Policies\LinkPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Link::class => LinkPolicy::class,
        Domain::class => DomainPolicy::class,
        Permission::class => PermissionPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
