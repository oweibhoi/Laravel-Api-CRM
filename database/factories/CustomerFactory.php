<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this->faker->randomElement(["B", "I"]);
        $name = $type === 'B' ? $this->faker->company() : $this->faker->name();
        $status = $this->faker->randomElement(["0", "1", "2"]);
        return [
            'name' => $name,
            'type' => $type,
            'email' => $this->faker->email(),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postCode(),
            'phone' => $this->faker->phoneNumber(),
            'status' => $status
        ];
    }
}
