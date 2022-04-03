<?php

namespace Database\Factories;

use App\Models\Alumno;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AlumnoFactory extends Factory
{
    protected $model = Alumno::class;

    public function definition()
    {
        return [
			'code' => $this->faker->name,
			'name' => $this->faker->name,
			'address' => $this->faker->name,
			'mobile' => $this->faker->name,
			'email' => $this->faker->name,
        ];
    }
}
