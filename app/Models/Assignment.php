<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $table = "assignments";
    protected $fillable = ['professorId', 'title', 'description', 'deadline',
                           'maxGrade', 'pictureLocation'];
    public function Professor(){
        return $this->belongsTo(Professor::class, "professorId");
    }
    public function AssignedCourses(){
        return $this->hasMany(AssignedCourses::class, "assignmentId");
    }
    public function AssignmentAttachments(){
        return $this->hasMany(AssignmentAttachment::class, "assignmentId");
    }
    public function Submissions(){
        return $this->hasMany(Submission::class, "assignmentId");
    }
}
