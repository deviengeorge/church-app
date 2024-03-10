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
        Schema::create('school_student_infos', function (Blueprint $table) {
            $table->id();

            // School Many To One
            $table->foreignId('school_id')->nullable()->constrained()->nullOnDelete();

            $table->string("grade")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_student_infos');
    }
};
