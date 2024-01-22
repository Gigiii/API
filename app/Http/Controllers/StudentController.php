<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    protected $model = Student::class;
    
    /**
     * Return a specific student
     */
    public function showStudent($id){

        return response()->json(Student::findOrFail($id));
        
    }

}
