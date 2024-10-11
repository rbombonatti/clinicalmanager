<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HealthInsurancePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $healthInsurancePlans = [
            'UNIMED',
            'BRADESCO',
            'PARTICULAR',
            'PETROBRAS',
            'PREFEITURAS',
            'SUS',
        ];

        foreach ($healthInsurancePlans as $healthInsurancePlan) {
            DB::table('health_insurance_plans')->insert([
                'title' => $healthInsurancePlan,
            ]);
        }
    }
}
