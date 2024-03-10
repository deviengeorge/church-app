<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('university_student_infos', function (Blueprint $table) {
            $table->id();

            // University Many To One
            $table->foreignId('university_id')->nullable()->constrained()->nullOnDelete();

            // Faculty Many To One
            $table->foreignId('faculty_id')->nullable()->constrained()->nullOnDelete();

            $table->year('start')->nullable();
            $table->year('end')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_student_infos');
    }
};
