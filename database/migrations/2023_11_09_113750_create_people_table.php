<?php

use App\Models\Family;
use App\Models\SchoolStudentInfo;
use App\Models\UniversityStudentInfo;
use App\Models\WorkerInfo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();

            // Name
            $table->string('name');
            // 5 Name Array
            $table->json('names');

            $table->string('alias_name')->nullable();

            $table->json('phones')->nullable();
            $table->json('whatsapp_phones')->nullable();
            $table->string('gender')->nullable();
            $table->string('status')->nullable();
            $table->date('date_of_death')->nullable();
            $table->string('note')->default('')->nullable();
            $table->string('confession_priest')->nullable();
            $table->date('birthday')->nullable();

            // Family One To Many
            // $table->foreignId('family_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Family::class, "family_id")->nullable()->cascadeOnDelete();
            $table->string('family_role')->nullable();

            $table->string('title')->nullable();

            // worker_info_id
            $table->foreignIdFor(WorkerInfo::class, "worker_info_id")->nullable()->constrained()->cascadeOnDelete();

            // $table->foreignId('worker_info_id')->nullable()->constrained(table: "worker_infos")->cascadeOnDelete();
            // $table->unique('worker_info_id');

            // school_student_id
            $table->foreignIdFor(SchoolStudentInfo::class, "school_student_info_id")->nullable()->constrained()->cascadeOnDelete();

            // $table->foreignId('school_student_info_id')->nullable()->constrained(table: "school_student_infos", column: "id")->cascadeOnDelete();
            // $table->unique('school_student_info_id');

            // university_student_id
            $table->foreignIdFor(UniversityStudentInfo::class, "university_student_info_id")->nullable()->constrained()->cascadeOnDelete();

            // $table->foreignId('university_student_info_id')->nullable()->constrained(table: "university_student_infos")->cascadeOnDelete();
            // $table->unique('university_student_info_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
