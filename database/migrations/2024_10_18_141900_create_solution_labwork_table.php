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
        Schema::create('solution_labwork', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // FK to Student
            $table->foreignId('labwork_id')->constrained('labwork')->onDelete('cascade'); // FK to Labwork
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); // FK to Course
            $table->integer('mark')->nullable(); // Mark (Optional)
            $table->string('file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solution_labwork');
    }
};
