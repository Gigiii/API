<?php

namespace App\Http\Controllers;

use App\Models\SubmissionAttachment;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Assignment;
use Carbon\Carbon;

class SubmissionController extends Controller
{
    protected $model = Submission::class;

    /**
     * Create a submission
     */
    public function createSubmission(Request $request, $assignmentId){
        if(auth()->user()->role == "Student"){

            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'status' => 'required|boolean',
                'fileLocations' => 'required',
                ]);
            $submission = new Submission;
            $submission->title = $request->title;
            $submission->description = $request->description;
            $submission->submissionDate = Carbon::now();
            $submission->status = $request->status;
            $submission->studentId = auth()->user()->user_id;
            $submission->assignmentId = $assignmentId;
            $submission->saveOrFail();
            foreach ($request->fileLocations as $fileLocation){
                $newRequest = new Request();
                $newRequest->merge([
                    'submissionId' => $submission->id,
                    'fileLocation' => $fileLocation
                ]);
                $this->createSubmissionAttachment($newRequest);  
            }
            return response()->json($submission);

        }else{
            return response("Only a student can create a submission", 403);
        }
    }

    /**
     * Give a grade to an existing submission
     */
    public function gradeSubmission(Request $request, $submissionId){
        if(auth()->user()->role == "Professor"){
            $request->validate([
                'grade' => 'required|numeric'
                ]);
            $assignment = Submission::findOrFail($submissionId); 
            $assignment->update($request->all());
            return response()->json(['message' => 'Submission graded successfully']);

        }else{
            return response("Only a professor can grade a submission", 403);
        }
    }

    /**
     * Return a specific submission
     */
    public function showSubmission($studentId, $assignmentId){
        $submission = Submission::where('studentId', $studentId)
        ->where('assignmentId', $assignmentId)->firstOrFail();
        $student = $submission->student;
        $attachment  = $submission->attachment;
        return response()->json($submission);
    }

    /**
     * Check if a student has submitted
     */
    public function checkSubmission($studentId, $assignmentId){
        $submission = Submission::where('studentId', $studentId)
        ->where('assignmentId', $assignmentId)->first();
        if ($submission != null) {
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * Return all submissions
     */
    public function showSubmissions($assignmentId){
        $submissions = Submission::where('assignmentId', $assignmentId)->get();

        
        foreach ($submissions as $submission) {
            $student = $submission->student;
        }

        return response()->json($submissions);
    }

    /**
     * Return all attachments for a submission
     */
    private function showSubmissionAttachments($id){

        return response()->json(SubmissionAttachment::where('submissionId', $id)->get());

    }

    /**
     * Create an attachment for an existing submission
     */
    public function createSubmissionAttachment(Request $request){

        if(auth()->user()->role == "Student"){

        $request->validate([
            'fileLocation' => 'required',
            'submissionId' => 'required'
        ]);

        $attachment = new SubmissionAttachment;
        $attachment->submissionId = $request->submissionId;
        $attachment->fileLocation = $request->fileLocation;
        $attachment->saveOrFail();
        return response()->json(['message' => 'Attachment created successfully', 'entry' => $attachment]);

        }else{

            return response("Only a student can create an attachment", 403);
            
        }
    }

}
