<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\output>
 */
class outputFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word, // Genera una palabra aleatoria como nombre
        ];
    }
}
