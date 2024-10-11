<?php

use App\Models\Doctor;
use App\Models\HealthInsurancePlan;
use App\Models\Procedure;
use App\Models\User;
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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->bigInteger('consultation_number')->unique();
            $table->date('consultation_date');
            $table->foreignIdFor(Doctor::class)->constrained();
            $table->foreignIdFor(Procedure::class)->nullable()->constrained();
            $table->foreignIdFor(HealthInsurancePlan::class)->nullable()->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->enum('type', ['Consulta', 'Cirurgia'])->default('Consulta');
            $table->enum('source', ['Equipe', 'Cassiana', 'Vanessa'])->nullable();
            $table->enum('followup', ['Equipe', 'Cassiana', 'Vanessa'])->nullable();
            $table->float('reference_price')->nullable();
            $table->float('paid_price')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('observation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
