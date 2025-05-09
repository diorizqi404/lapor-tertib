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
            Schema::create('students', function (Blueprint $table) {
                $table->id();
                $table->foreignId('school_id')->constrained()->onDelete('cascade');
                $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
                $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
                $table->string('nis');
                $table->string('name');
                $table->enum('gender', ['L', 'P']);
                $table->string('photo')->nullable();
                $table->string('parent_phone');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('students');
        }
    };
