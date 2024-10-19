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
        Schema::create('exam_committee', function (Blueprint $table) {
            $table->id();$table->integer('year'); // Year of the committee
            $table->string('type'); // Type of the exam committee (e.g., "mid", "final")
            $table->integer('level'); // Level associated with the committee
            $table->string('semester'); // Semester associated with the committee
            
            // Foreign keys for chairman and members
            $table->foreignId('chairman')->constrained('teachers'); // Assuming the chairman is from the Teacher table
            $table->foreignId('member_1')->constrained('teachers'); // Assuming members are also from the Teacher table
            $table->foreignId('member_2')->constrained('teachers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_committee');
    }
};
