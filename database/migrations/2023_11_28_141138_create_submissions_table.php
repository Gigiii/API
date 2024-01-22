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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studentId');
            $table->foreign('studentId')->references('id')->on('students')->onDelete('cascade');
            $table->foreignId('assignmentId');
            $table->foreign('assignmentId')->references('id')->on('assignments')->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->dateTime('submissionDate');
            $table->integer('grade')->nullable();;
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
