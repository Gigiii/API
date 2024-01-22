<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrolledCourses extends Model
{
    use HasFactory;
    protected $table = "enrolled_courses";
    public function Course(){
        return $this->belongsTo(Course::class, "courseId");
    }
    
    public function Students(){
        return $this->belongsToMany(Student::class, "studentId");
    }
}
