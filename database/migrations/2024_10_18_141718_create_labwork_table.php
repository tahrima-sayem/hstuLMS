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
        Schema::create('labwork', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Title
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); // FK to Course
            $table->text('description')->nullable(); // Description
            $table->string('file')->nullable(); // File (binary)
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labwork');
    }
};
