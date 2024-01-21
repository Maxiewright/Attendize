<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_id' => function () {
                return \App\Models\Account::factory()->create()->id;
            },
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
            'confirmation_code' => $this->faker->randomNumber(),
            'is_registered' => false,
            'is_confirmed' => false,
            'is_parent' => false,
            'remember_token' => $this->faker->randomNumber(),
        ];
    }
}
