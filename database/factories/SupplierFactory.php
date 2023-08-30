<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->company,
            'ice' => fake()->numberBetween(10000000, 99999999),

            'email' => fake()->unique()->safeEmail,
            'telephone' => fake()->regexify('06\d{8}'),
            'adresse' => fake()->address,
            'site_web' => fake()->url,
            'ville' => fake()->city,

        ];
    }
}
