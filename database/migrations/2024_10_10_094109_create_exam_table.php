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
        Schema::create('exam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); // FK to Course
            $table->text('syllabus')->nullable(); // Syllabus (optional, can hold a large amount of text)
            $table->date('date'); // Exam Date
            $table->enum('category', ['mid', 'quiz', 'final']); // Category: either 'mid', 'quiz', or 'final'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam');
    }
};
