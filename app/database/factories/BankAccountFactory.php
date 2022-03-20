<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BankAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'account_number' => $this->faker->bankAccountNumber,
            'interest_percentage' => $this->faker->randomFloat(2, 0, 0.99),
            'cash' => $this->faker->randomFloat(10, 0, 9999999.99),
        ];
    }
}
