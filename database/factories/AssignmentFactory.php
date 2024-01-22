<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Professor;
use App\Models\Assignment;

class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Assignment::class;
    public function definition(): array
    {
        return [
            'professorId' => function () {
                return Professor::factory()->create()->id;
            },
            'title' => $this->faker->sentence,
            'Description' => $this->faker->realText,
            'deadline' => $this->faker->dateTime,
            'maxGrade' => $this->faker->numberBetween(0,20),
            'pictureLocation' => $this->faker->url,
            'status' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
