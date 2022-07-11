<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'email' => 'admin@test.com',
            'password' => 'secret',
        ]);

        $user->assignRole('admin');

        /** @var User $user */
        $user = factory(User::class)->create([
            'email' => 'manager@test.com',
            'password' => 'secret',
        ]);

        $user->assignRole('manager');

        /** @var User $user */
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
            'password' => 'secret',
        ]);
    }
}
