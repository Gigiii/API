<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Professor;
use App\Models\Course;
use App\Models\CourseProfessors;

class CourseProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CourseProfessor::class;
    public function definition(): array
    {
        return [
            'professorId' => function () {
                return Professor::factory()->create()->id;
            },
            'courseId' => function () {
                return Course::factory()->create()->id;
            },
        ];
    }
}
