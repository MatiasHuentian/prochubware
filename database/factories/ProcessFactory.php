<?php

namespace Database\Factories;

use App\Models\Dependency;
use App\Models\Process;
use App\Models\ProcessesState;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProcessFactory extends Factory
{
    protected $model = Process::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'objective' => $this->faker->paragraph,
            'introduction' => $this->faker->paragraph,
            'contextual_memo' => $this->faker->paragraph,
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('d/m/Y'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('d/m/Y'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'owner_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'dependency_id' => function () {
                return Dependency::inRandomOrder()->first()->id;
            },
            'state_id' => function () {
                return ProcessesState::inRandomOrder()->first()->id;
            },
        ];
    }
}
