<?php

use App\Models\Permission\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedDefaultRoles extends Migration
{
    private $roles = [
        'admin' => [
            'access-admin-dashboard',
            'manage-all-links',
            'manage-domains',
            'manage-users',
            'manage-roles',
        ],
        'manager' => [
            'access-admin-dashboard',
            'manage-all-links',
        ],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->roles as $name => $permissions) {
            /** @var Role $role */
            $role = Role::create([
                'name' => $name,
            ]);

            $role->syncPermissions($permissions);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('roles')
            ->whereIn('name', array_keys($this->roles))
            ->delete();
    }
}
