<?php

use App\Models\Domain;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    public function run()
    {
        Domain::create([
            'name' => 'http://links.envant.me',
        ]);

        Domain::create([
            'name' => 'http://shorty.envant.me',
        ]);
    }
}
