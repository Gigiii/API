<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Assignment;
use App\Models\Submission;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Submission::class;
    public function definition(): array
    {
        return [
            'studentId' => Student::factory()->create()->id,
            'assignmentId' => Assignment::factory()->create()->id,
            'title' => $this->faker->title,
            'description' => $this->faker->paragraph,
            'submissionDate' => $this->faker->dateTime,
            'grade' => $this->faker->numberBetween(0,200),
            'status' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
