<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject_id' => 1,
            'user_id' => 1,
            'name' => 'Note '.random_int(0,1000),
            'description' => $this->faker->words(20, true),
        ];
    }
}
