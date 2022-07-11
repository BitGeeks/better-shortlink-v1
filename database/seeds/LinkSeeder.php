<?php

use App\Models\Link;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class LinkSeeder extends Seeder
{
    public function run()
    {
        $links = factory(Link::class, 30)->create();

        /** @var Collection $tags */
        $tags = Tag::get();

        foreach ($links as $link) {
            $link->tags()->sync($tags->random(rand(0, 4)));
        }
    }
}
