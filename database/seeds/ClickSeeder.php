<?php

use App\Models\Click;
use App\Models\Link;
use Illuminate\Database\Seeder;

class ClickSeeder extends Seeder
{
    public function run()
    {
        $links = Link::get();

        foreach ($links as $link) {
            factory(Click::class, rand(0, 100))->create([
                'link_id' => $link->id,
            ]);
        }
    }
}
