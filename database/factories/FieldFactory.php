<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\School;
use App\Models\Field;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Field>
 */
class FieldFactory extends Factory
{

    protected $model = Field::class;

    public function definition(): array
    {
        $pastSeederIds = School::pluck('id')->toArray();
        $randomId = $this->faker->randomElement($pastSeederIds);

        return [
            "Name"=> $this->faker->name,
            'SchoolId' => $randomId
        ];
    }
}
