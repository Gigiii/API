<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentAttachment extends Model
{
    use HasFactory;
    protected $table = "assignment_attachments";
    protected $fillable = ['fileLocation', "assignmentId"];

    public function Assignment(){
        return $this->belongsTo(Assignment::class, "assignmentId");
    }
}
