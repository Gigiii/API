<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionAttachment extends Model
{
    use HasFactory;
    protected $table = "submission_attachments";
    protected $fillable = ['FileLocation'];

    public function Submission(){
        return $this->belongsTo(Submission::class, "submissionId");
    }
}
