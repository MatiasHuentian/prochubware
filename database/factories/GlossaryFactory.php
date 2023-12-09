<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GlossaryFactory extends Factory
{
    public function definition()
    {
        return [
            'term' => $this->faker->word, // Genera una palabra aleatoria como nombre
        ];
    }
}
