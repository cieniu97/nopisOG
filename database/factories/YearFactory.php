<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class YearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types_in_yeras=['dzienne', 'zaoczne'];
        $year = random_int(2000, 2022);
        return [
            'field_id' => 1,
            'name' => $year."/".($year+1),
            'type' => $types_in_yeras[array_rand($types_in_yeras)],
        ];
    }
}
