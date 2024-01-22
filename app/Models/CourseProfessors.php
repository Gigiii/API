<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseProfessors extends Model
{
    use HasFactory;
    protected $table = 'course_professors';

    public function Course(){
        return $this->belongsTo(Course::class, "courseId");
    }
    
    public function Professors(){
        return $this->belongsToMany(Professor::class, "professorId");
    }
}
