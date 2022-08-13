<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Location;
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
        Block::factory(1000)->create();
        Location::factory(6)->create();
    }
}
