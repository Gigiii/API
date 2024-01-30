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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professorId');
            $table->foreign('professorId')->references('id')->on('professors')->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->dateTime('deadline');
            $table->tinyInteger('maxGrade');
            $table->string('pictureLocation');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
