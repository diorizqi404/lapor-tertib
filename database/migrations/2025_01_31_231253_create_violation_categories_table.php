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
        Schema::create('violation_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id')->constrained('schools', 'id')->onDelete('cascade');
            $table->string('name');
            $table->integer('point');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violation_categories');
    }
};
