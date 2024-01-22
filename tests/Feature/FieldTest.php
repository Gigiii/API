<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Field;
use App\Models\School;

class FieldTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $field = Field::factory()->create();

        $this->assertInstanceOf(Field::class, $field);

    }
}
