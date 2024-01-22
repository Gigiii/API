<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $fillable = ['name', 'credits', 'timetable', 'pictureLocation', 'updated_at', 'created_at'];

    public function Field(){
        return $this->belongsTo(Field::class, 'fieldId');
    }
    public function AssignedCourses(){
        return $this->hasMany(AssignedCourses::class);
    }

    public function EnrolledCourses(){
        return $this->hasMany(EnrolledCourses::class);
    }
}
