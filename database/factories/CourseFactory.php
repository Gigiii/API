<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Field;
use App\Models\Course;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Course::class;
    public function definition(): array
    {
        return [
            'fieldOfStudyId' => function () {
                return Field::factory()->create()->id;
            },
            'name' => $this->faker->text(50),
            'credits' => $this->faker->numberBetween(1,6),
            'timetable' => $this->faker->text(100),
            'pictureLocation'=> $this->faker->url,
        ];
    }
}
