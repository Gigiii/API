<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedCourses extends Model
{
    use HasFactory;
    protected $table = "assigned_courses";

    public function Course(){
        return $this->belongsTo(Course::class, "courseId");
    }
    public function Assignment(){
        return $this->belongsTo(Assignment::class, "assignmentId");
    }
}
