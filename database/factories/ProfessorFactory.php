<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Field;
use App\Models\Professor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professor>
 */
class ProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Professor::class;

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
            'title' => $this->faker->title,
            'salary'=> $this->faker->numberBetween(30000,100000),
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
