<?php

use App\Models\School;
use Tests\TestCase;

class SchoolTest extends TestCase
{
    public function testCreateSchool()
    {
        $school = School::factory()->create([
            'name' => 'IPBeja Management',
        ]);

        $this->assertInstanceOf(School::class, $school);
        $this->assertEquals('IPBeja Management', $school->name);
    }
}

?>