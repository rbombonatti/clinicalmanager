<?php

use App\Models\Doctor;
use App\Models\Specialty;
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
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('doctor_specialty', function (Blueprint $table) {
           $table->id();
           $table->foreignIdFor(Doctor::class)->constrained();
           $table->foreignIdFor(Specialty::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialties');
        Schema::dropIfExists('doctor_specialty');
    }
};
