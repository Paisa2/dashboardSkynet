<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ambiente'      =>$this->faker->numberBetween(1,20),
            'hora_ini'  =>$this->faker->dateTimeThisCentury->format('Y-m-d'),
            'hora_fin'  =>$this->faker->dateTimeThisCentury->format('Y-m-d'),
            'dia'  =>$this->faker->text(100),
        ];
    }
}
