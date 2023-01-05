<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActivitieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->text,
            'body_part' => $this->faker->numberBetween(1, 6),
        ];
    }
}
