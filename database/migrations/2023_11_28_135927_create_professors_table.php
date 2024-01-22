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
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fieldOfStudyId');
            $table->foreign('fieldOfStudyId')->references('id')->on('fields')->onDelete('cascade');
            $table->string('firstName');
            $table->string('lastName');
            $table->tinyInteger('age');
            $table->boolean('gender');
            $table->string('title');
            $table->integer('salary');
            $table->string('nationality');
            $table->string('address');
            $table->string('email');
            $table->string('phoneNumber');
            $table->string('pictureLocation');
            $table->boolean('accountStatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professors');
    }
};
