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
        Schema::create('violations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id')->constrained('schools', 'id')->onDelete('cascade');
            $table->unsignedBigInteger('teacher_id')->constrained('users', 'id')->onDelete('cascade');
            $table->unsignedBigInteger('student_id')->constrained('students', 'id')->onDelete('cascade');
            $table->unsignedBigInteger('violation_category_id')->constrained('violation_categories', 'id')->onDelete('cascade');
            $table->datetime('datetime');
            $table->text('description');
            $table->integer('point');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violations');
    }
};
