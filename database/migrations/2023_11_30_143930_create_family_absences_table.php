<?php

use App\Models\Family;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('family_absences', function (Blueprint $table) {
            $table->id();
            $table->string('details');

            // Family One To Many
            // $table->foreignId('family_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Family::class)->constrained()->cascadeOnDelete();

            // Absence Reason One To Many
            $table->foreignId('reason_id')
                ->constrained(
                    table: 'family_absence_reasons',
                    column: 'id'
                )
                ->nullOnDelete();

            $table->timestamp('visited_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_absences');
    }
};
