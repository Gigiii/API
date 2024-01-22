<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;

class ProfessorController extends Controller
{
    protected $model = Professor::class;

    /**
     * Return a specific professor
     */
    public function showProfessor($id){

        return response()->json(Professor::findOrFail($id));

    }
}
