<?php

namespace Database\Seeders;

use App\Models\Block;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Уилмингтон (Северная Каролина)',
            'Портленд (Орегон)',
            'Торонто',
            'Варшава',
            'Валенсия',
            'Шанхай'
        ];

        $roles = [
          'user',
          'admin'
        ];

        foreach($roles as $role) {
            DB::table('roles')->insert([
                'name'       => $role,
                'guard_name' => 'web'
            ]);
        }

        foreach($names as $name) {
            DB::table('locations')->insert([
                'name' => $name,
                'slug' => Str::slug($name)
            ]);
        }

        Block::factory(2500)->create();
    }
}
