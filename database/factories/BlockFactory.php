<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word() . '-' . $this->faker->numberBetween(11111, 99999);

        return [
            'name'         => $name,
            'slug'         => Str::slug($name),
            'location_id'  => Location::get()->random()->id,
            'available'    => rand(0, 1)
        ];
    }
}
