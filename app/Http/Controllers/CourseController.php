<?php

namespace App\Http\Controllers;

use App\Models\AssignedCourses;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseProfessors;
use App\Models\EnrolledCourses;


class CourseController extends Controller
{
    protected $model = Course::class;

    /**
     * Return all the courses taught by a professor or enrolled in by a student
     */
    public function showCourses($id){
        if(auth()->user()->role == "Professor") {

            $courses = CourseProfessors::where('professorId', $id)->get();
            $courseArray = [];
            foreach ($courses as $course) {
                array_push($courseArray, Course::findOrFail($course->courseId));
            }
            return response() -> json($courseArray);

        }else{
            
            $courses = EnrolledCourses::where('studentId', $id)->get();
            $courseArray = [];
            foreach ($courses as $course) {
                array_push($courseArray, Course::findOrFail($course->courseId));
            }
            return response() -> json($courseArray);
        }
    }

    /**
     * Return information about a singular course taught by/enrolled in a professor/student
     */
    public function showCourse($id, $courseId){

        if(auth()->user()->role == "Professor") {

            $course = CourseProfessors::where('professorId', $id)->where('courseId', $courseId)->get();
            if ($course->count() > 0) {
                return response() -> json(Course::findOrFail($courseId));
            }else{
                return response("Error, No course found or access denied");
            }

        }else{

            $course = EnrolledCourses::where('studentId', $id)->where('courseId', $courseId)->get();
            if ($course->count() > 0) {
                
                return response() -> json(Course::findOrFail($courseId));

            }else{

                return response("Error, No course found or access denied");
                
            }

        }
    }

}
