<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedDefaultPermissions extends Migration
{
    private $permissions = [
        'access-admin-dashboard',
        'manage-all-links',
        'manage-domains',
        'manage-users',
        'manage-roles',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('permissions')
            ->insert(array_map(function ($permission) {
                return [
                    'name' => $permission
                ];
            }, $this->permissions));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permissions')
            ->whereIn('name', $this->permissions)
            ->delete();
    }
}
