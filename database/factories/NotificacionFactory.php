<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotificacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email'  =>$this->faker->unique()->safeEmail,
            'mensaje' =>$this->faker->text(100),
            'dia'  =>$this->faker->dateTimeThisCentury->format('Y-m-d'),
            'solicitud'  =>$this->faker->numberBetween(1,20)
        ];
    }
}
