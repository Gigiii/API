<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Submission;
use App\Models\SubmissionAttachment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubmissionAttachment>
 */
class SubmissionAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SubmissionAttachment::class;
    public function definition(): array
    {
        return [
            'submissionId' => Submission::factory()->create()->id,
            'fileLocation' => now()
        ];
    }
}
