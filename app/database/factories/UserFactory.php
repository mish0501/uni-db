<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\bg_BG\Payment($this->faker));
        $this->faker->addProvider(new \Faker\Provider\bg_BG\PhoneNumber($this->faker));
        $this->faker->addProvider(new \Faker\Provider\bg_BG\Person($this->faker));

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'PID' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'remember_token' => Str::random(10),
        ];
    }
}
