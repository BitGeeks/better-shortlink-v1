<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        // $this->call(DomainSeeder::class);

        if (config('app.env') == 'demo') {
            $this->call(TagSeeder::class);
            $this->call(LinkSeeder::class);
            $this->call(ClickSeeder::class);
        }
    }
}
