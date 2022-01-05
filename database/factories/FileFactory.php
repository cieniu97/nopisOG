<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'note_id' => 1,
            'name' => bin2hex(random_bytes(16)),
            'path' => bin2hex(random_bytes(16)).'.extention',

        ];
    }
}
