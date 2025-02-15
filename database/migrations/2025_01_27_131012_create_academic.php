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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id')->constrained('schools', 'id')->onDelete('cascade');
            $table->string('name');
            $table->string('initial');
            $table->timestamps();
        });

        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id')->constrained('schools', 'id')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id')->constrained('schools', 'id')->onDelete('cascade');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->unsignedBigInteger('grade_id')->constrained('grades', 'id')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
        Schema::dropIfExists('grades');
        Schema::dropIfExists('classes');
    }
};
