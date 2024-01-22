<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#Authorization Routes
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login',  [AuthenticationController::class, 'login']);

#Assignment Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/assignment/createAssignment', [AssignmentController::class, 'createAssignment']);
    Route::get('/assignment/showAssignments/{courseId}', [AssignmentController::class, 'showAssignments']);
    Route::get('/assignment/showAssignment/{assignmentId}', [AssignmentController::class, 'showAssignment']);
    Route::patch('/assignment/updateAssignment/{assignmentId}', [AssignmentController::class, 'updateAssignment']);
    Route::delete('/assignment/deleteAssignment/{assignmentId}', [AssignmentController::class, 'deleteAssignment']);
   
});

#Submission Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/submission/createSubmission/{assignmentId}', [SubmissionController::class, 'createSubmission']);
    Route::patch('/submission/gradeSubmission/{submissionId}', [SubmissionController::class, 'gradeSubmission']);
    Route::get('/submission/showSubmissions/{assignmentId}', [SubmissionController::class, 'showSubmissions']);
    Route::get('/submission/showSubmission/{studentId}/{assignmentId}', [SubmissionController::class, 'showSubmission']);
    Route::post('/submission/createSubmissionAttachment/{submissionId}', [SubmissionController::class, 'createSubmissionAttachment']);
});

#Course Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/course/showCourses/{Id}', [CourseController::class, 'showCourses']);
    Route::get('/course/showCourse/{Id}/{courseId}', [CourseController::class, 'showCourse']);

});


#Student routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/student/showStudent/{studentId}', [StudentController::class, 'showStudent']);

});

#Professor routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/professor/showProfessor/{professorId}', [ProfessorController::class, 'showProfessor']);

});