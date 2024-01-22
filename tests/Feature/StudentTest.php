<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Field;
use App\Models\Student;

class StudentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $student = Student::factory()->create();
        $this->assertInstanceOf(Student::class, $student);
        $this->assertInstanceOf(Field::class, $student->Field);

    }
}
