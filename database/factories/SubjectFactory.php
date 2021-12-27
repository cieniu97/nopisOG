<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'year_id' => 1,
            'semester' => random_int(1, 10),
            'teacher' => $this->faker->name(),
            'name' => 'Subject '.random_int(0,1000),
        ];
    }
}
