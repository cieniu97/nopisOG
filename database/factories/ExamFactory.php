<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
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
            'name' => 'exam '.random_int(0,1000),
            'date' => random_int((time()-1000000),(time()+3000000)),
            'description' => $this->faker->text(100),
        ];
    }
}
