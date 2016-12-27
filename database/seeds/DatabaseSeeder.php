<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CategoryIdTableSeed::class);
         $this->call(RatingsIdTableSeeder::class);
         $this->call(WhereStringPostsTableSeeder::class);
         $this->call(RatingsTableSeed::class);
    }
}
