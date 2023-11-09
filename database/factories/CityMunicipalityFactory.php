<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CityMunicipality>
 */
class CityMunicipalityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city' => \Faker\Factory::create()->city,
            'zip' => \Faker\Factory::create()->postcode,
            'state' => \Faker\Factory::create()->state,
            'region' => \Faker\Factory::create()->word, // Modify this to generate region data as needed
        ];
    }
}
