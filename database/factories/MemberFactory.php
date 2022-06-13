<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => \Illuminate\Support\Str::uuid()->toString(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement(['male', 'female', 'indeterminate', 'unknown']),
            'weight' => $this->faker->randomDigit(),
            'birthday' => $this->faker->date(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->safeEmail(),
            'password' => $this->faker->password(8),
            'avatar' => $this->faker->imageUrl()
        ];
    }
}
