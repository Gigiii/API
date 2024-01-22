<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assigned_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignmentId');
            $table->foreign('assignmentId')->references('id')->on('assignments')->onDelete('cascade');
            $table->foreignId('courseId');
            $table->foreign('courseId')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigned_courses');
    }
};
