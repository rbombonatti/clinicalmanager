<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\HealthInsurancePlan;
use App\Models\Procedure;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paidPrice = $this->faker->randomElement(
            [
                $this->faker->randomFloat(2, 100, 1000),
                null
            ]);

        $paidPrice = null;

        return [
            'patient_name' => $this->faker->name(),
            'consultation_number' => random_int(100000, 10000000),
            'consultation_date' => $this->faker->dateTimeBetween('2024-09-01', '2024-09-30'),
            'doctor_id' => 1,
            'procedure_id' => null, //Procedure::all()->random()->id,
            'health_insurance_plan_id' => null, // HealthInsurancePlan::all()->random()->id,
            'user_id' => 1,
            'type' => $this->faker->randomElement(['Consulta', 'Cirurgia']),
            'source' => $this->faker->randomElement(['Equipe', 'Cassiana', 'Vanessa']),
            'followup' => $this->faker->randomElement(['Equipe', 'Cassiana', 'Vanessa']),
            'reference_price' => null,
            'paid_price' => $paidPrice,
            'payment_date' => $paidPrice
                ? $this->faker->dateTimeBetween('2024-09-01', '2024-09-30')
                : null
        ];
    }
}
