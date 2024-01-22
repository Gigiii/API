<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $table = "submissions";
    protected $fillable = ['title', 'description',
                           'grade'];

    public function Student(){
        return $this->belongsTo(Student::class, "studentId");
    }
    public function Assignment(){
        return $this->belongsTo(Assignment::class, "assignmentId");
    }
}
