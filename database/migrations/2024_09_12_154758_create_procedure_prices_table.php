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
        Schema::create('procedure_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procedure_id')->constrained('procedures');
            $table->foreignId('health_insurance_plan_id')->constrained('health_insurance_plans');
            $table->foreignId('price_list_id')->constrained('price_lists');
            $table->decimal('price', 8, 2)->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedure_prices');
    }
};
