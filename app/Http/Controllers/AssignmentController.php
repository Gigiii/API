<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\AssignmentAttachment;
use App\Models\AssignedCourses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\EnrolledCourses;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{

    protected $model = Assignment::class;

    /**
     * Create an Assignment
     */
    public function createAssignment(Request $request)
    {
        if(auth()->user()->role == "Professor"){
            $request->validate([
                'professorId' => 'required',
                'title' => 'required',
                'description' => 'required',
                'maxGrade' => 'required|numeric',
                'deadline'=> 'required|date',
                'pictureLocation' => 'required',
                'status' => 'required|boolean',
                'fileLocations' => 'required',
                'courseId' => 'required',
                ]);
            $assignmentData = $request->except('fileLocations', 'courseId');
            $assignment = Assignment::create($assignmentData);
            foreach ($request->fileLocations as $fileLocation){

                $newRequest = new Request();
                $newRequest->merge([
                    'assignmentId' => $assignment->id,
                    'fileLocation' => $fileLocation
                ]);
                $this->createAttachment($newRequest);  
            }

            $assignedCourse = AssignedCourses::create([
                'courseId' => $request->courseId,
                'assignmentId' => $assignment->id
            ]);
            return response()->json($assignment);

        }else{
            return response("Only a professor can create an assignment", 403);
        }
    }



    private function showAssignmentAttachments(string $id)
    {
        $attachments = AssignmentAttachment::where('assignmentId', $id)->get();
        return response()->json($attachments);
    }

    /**
     * Display the Assignment alongside its attachments
     */
    public function showAssignment($id)
    {
        $courseId = AssignedCourses::where('assignmentId', $id)->pluck('courseId');
        $courseCounts = EnrolledCourses::where('courseId', $courseId)->count();
        $assignment = Assignment::findOrFail($id);        
        $submissionCount = $assignment->submissions()->count();
        $attachments = $this->showAssignmentAttachments($id);
        return response()->json([
            'assignment' => $assignment,
            'attachments' => $attachments,
            'student_count' => $courseCounts,
            'submission_count' => $submissionCount
        ]);
    }

    /**
     * Display all Assignments of a course
     */
    public function showAssignments($id)
    {
        $assignments = AssignedCourses::where('courseId', $id)->get();
        $assignmentList = [];
        foreach ($assignments as $assignment) {
            array_push($assignmentList, $this->showAssignment($assignment-> assignmentId));
        }
        return response($assignmentList);
    }

    /**
     * Update the specified Assignment
     */
    public function updateAssignment(Request $request, int $id)
    {

        if(auth()->user()->role == "Professor"){
            $request->validate([
                'professorId' => 'required',
                'title' => 'required',
                'description' => 'required',
                'maxGrade' => 'required|numeric',
                'deadline'=> 'required|date',
                'pictureLocation' => 'nullable',
                'status' => 'required|boolean',
                'fileLocations' => 'required',
                ]);
            $assignmentData = $request->except('fileLocations');
            $assignment = Assignment::findOrFail($id); 
            $assignment->update($assignmentData);
            foreach ($request->fileLocations as $fileLocation){
                $newRequest = new Request();
                $newRequest->merge([
                    'assignmentId' => $assignment->id,
                    'fileLocation' => $fileLocation
                ]);
                $this->createAttachment($newRequest);  

            }
            return response()->json($assignment);

        }else{
            return response("Only a professor can create an assignment", 403);
        }
    }

    /**
     * Delete the Assignment
     */
    public function deleteAssignment($id)
    {
        $assignment = Assignment::findOrFail($id);

        if ($assignment) {
            $attachments = AssignmentAttachment::where('assignmentId', $id);

            foreach ($attachments as $attachment) {

                $this->deleteAttachment($attachment);

            }
            $assignment->delete();
            return response()->json(['status' => 'success', 'msg' => 'Assignment deleted successfully with attachments']);
     
        } else {
            
            return response()->json(['status' => 'fail', 'msg' => 'Assignment not found']);

        }
    }

    /**
     * Delete the Attachment
     */
    public function deleteAttachment(int $id){

        $attachment = AssignmentAttachment::findOrFail($id);

        if ($attachment) {

            $attachment->delete();
            return response()->json(['status' => 'success', 'msg' => 'Attachment deleted successfully']);
        
        } else {

            return response()->json(['status' => 'fail', 'msg' => 'Attachment not found']);

        }

    }

    /**
     * Create the Attachment
     */
    private function createAttachment(Request $request){

        $request->validate([
            'assignmentId' => 'required',
            'fileLocation' => 'required'
        ]);
        $attachment = AssignmentAttachment::create($request->all());
        return response()->json(['message' => 'Attachment created successfully', 'entry' => $attachment]);
 
    }
}