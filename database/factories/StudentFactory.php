<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Field;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{

    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'fieldOfStudyId' => function () {
                return Field::factory()->create()->id;
            },
            'firstName' => $this->faker->firstName,
            'lastName'=> $this->faker->lastName,
            'age'=> $this->faker->numberBetween(16,26),
            'gender'=> $this->faker->boolean,
            'typeOfDegree' => $this->faker->title,
            'academicYear'=> $this->faker->numberBetween(1,4),
            'nationality'=> $this->faker->country,
            'address'=> $this->faker->address,
            'email'=> $this->faker->unique()->safeEmail,
            'phoneNumber'=> $this->faker->phoneNumber,
            'pictureLocation'=> $this->faker->url,
            'accountStatus' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
