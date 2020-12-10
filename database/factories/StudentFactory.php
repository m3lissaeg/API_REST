<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator;

class StudentFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'lastName' => $this->faker->lastName,
            'age' => $this->faker->numberBetween($min = 10, $max = 900),
        ];
    }
}