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
        Schema::create('exam_mark', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // FK to Student
            $table->foreignId('exam_id')->constrained('exam')->onDelete('cascade'); // FK to Exam
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); // FK to Course
            $table->integer('mark')->nullable(); // Mark (integer, optional in case the mark hasn't been entered yet)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_mark');
    }
};
