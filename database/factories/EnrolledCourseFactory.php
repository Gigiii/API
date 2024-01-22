<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Course;
use App\Models\EnrolledCourses;

class EnrolledCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = EnrolledCourses::class;
    public function definition(): array
    {
        return [
            'studentId' => function () {
                return Student::factory()->create()->id;
            },
            'courseId' => function () {
                return Course::factory()->create()->id;
            },
        ];
    }
}
