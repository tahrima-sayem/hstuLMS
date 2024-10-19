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
        Schema::create('result', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // FK to Student
            $table->string('level'); // Level (e.g., undergraduate, graduate)
            $table->string('semester'); // Semester (e.g., Spring 2024)
            $table->decimal('total_credit', 5, 2); // Total credit as a decimal
            $table->decimal('gpa', 3, 2)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result');
    }
};
