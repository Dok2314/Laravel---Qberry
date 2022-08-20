<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

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

        Block::factory(1500)->create();

        User::create([
           'name'     => 'Demo',
           'email'    => 'demo',
           'password' => Hash::make('demo')
        ]);
    }
}
