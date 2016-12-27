<?php

use Illuminate\Database\Seeder;

class RatingsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rating_vanilla = \App\Rating::firstOrNew(['slug' => 'vanilla']);

        if (!$rating_vanilla->exists) {
            $rating_vanilla->fill([
                'name' => 'Vanilla',
                'slug' => 'vanilla',
                'description' => 'Just a story, nothing explicit to see here.'
            ])->save();
        }

        $rating_vanilla = \App\Rating::firstOrNew(['slug'  => 'neopolitan']);

        if (!$rating_vanilla->exists) {
            $rating_vanilla->fill([
                'name' => 'Neopolitan',
                'slug' => 'neopolitan',
                'description' => 'A more interesting story, with some definite innuendo.'
            ])->save();
        }

        $rating_vanilla = \App\Rating::firstOrNew(['slug'  => 'rocky_road']);

        if (!$rating_vanilla->exists) {
            $rating_vanilla->fill([
                'name' => 'Rocky Road',
                'slug' => 'rocky_road',
                'description' => 'Hookups containing straight up sex talk (Some more pleasant than others). You’ve been warned.
'
            ])->save();
        }
    }
}
