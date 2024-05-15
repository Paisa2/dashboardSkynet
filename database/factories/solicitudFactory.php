<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class solicitudFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cantidad'=>$this->faker->numberBetween(1,250),
            'motivo' =>$this->faker->text(100),
            'hora_ini'=>$this->faker->dateTimeThisCentury->format('Y-m-d'),
            'hora_fin'=>$this->faker->dateTimeThisCentury->format('Y-m-d'),
            'dia' =>$this->faker->text(10),
            'grupo' =>$this->faker->numberBetween(1,20),
            'ambiente' =>$this->faker->numberBetween(1,250),
            'materia' =>$this->faker->numberBetween(1,250),
            'docente'=>$this->faker->numberBetween(1,100),
        ];
    }
}
