<?php

use App\Enums\FamilyStatus;
use App\Models\Area;
use App\Models\Street;
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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('google_map_link')->nullable();

            // Area Many To One
            $table->foreignId('area_id')->nullable()->constrained()->nullOnDelete();

            // Street Many To One
            $table->foreignId('street_id')->nullable()->constrained()->nullOnDelete();

            // Street Many To One
            // TODO: What is this?
            $table->foreignId('family_id')->nullable()->constrained()->nullOnDelete();

            $table->string('building_num')->nullable();
            $table->string('floor_num')->nullable();
            $table->string('apartment_num')->nullable();
            $table->string('more_location_info')->nullable();

            $table->string('status')->default(FamilyStatus::IN_SERVICE);

            // priest ( User ) Many To One
            $table->foreignId('priest_id')->nullable()->constrained(table: "users", column: "id")->nullOnDelete();

            // Created By Many To One
            $table->foreignId('created_by')->nullable()->constrained(table: "users", column: "id")->nullOnDelete();

            // Updated By Many To One
            $table->foreignId('updated_by')->nullable()->constrained(table: "users", column: "id")->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
