<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\AssignmentAttachment;
use App\Models\AssignedCourses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


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
                'title' => 'required',
                'description' => 'required',
                'maxGrade' => 'required|numeric',
                'deadline'=> 'required|date',
                'pictureLocation' => 'required',
                'status' => 'required|boolean',
                ]);
            Assignment::create($request->all());
            return response()->json(['message' => 'Assignment created successfully']);

        }else{
            return response("Only a professor can edit an assignment", 403);
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
        $assignment = Assignment::findOrFail($id);
        $attachments = $this->showAssignmentAttachments($id);
        return response()->json([
            'Assignment' => $assignment,
            'Attachments' => $attachments
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
    public function updateAssignment(Request $request, $id)
    {

        if (auth()->user()->role == "Professor"){

            $request->validate([
                'title' => 'nullable',
                'description' => 'nullable',
                'maxGrade' => 'nullable|numeric',
                'deadline'=> 'nullable|date',
                'pictureLocation' => 'nullable',
                'status' => 'nullable|boolean',
                ]);
                $assignment = Assignment::findOrFail($id); 
                $assignment->update($request->all());
            return response()->json(['message' => 'Assignment updated successfully']);

        }else{

            return response("Only a professor can edit an assignment", 403);

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
    private function deleteAttachment(array $ids){

        foreach ($ids as $id) {

            $attachment = AssignmentAttachment::findOrFail($id);

            if ($attachment) {

                $attachment->delete();
                return response()->json(['status' => 'success', 'msg' => 'Attachment deleted successfully']);
           
            } else {

                return response()->json(['status' => 'fail', 'msg' => 'Attachment not found']);

            }

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