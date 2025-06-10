<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    public function definition(): array
    {
        $profils = ['PHARMACIEN', 'MEDECIN', 'BENEFICIAIRE']; // ADMIN exclu ici

        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'profil' => $this->faker->randomElement($profils),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // ou Hash::make('password')
            'remember_token' => Str::random(10),
            'created_at' => $this->faker->dateTimeBetween('-1year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1year', 'now'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
