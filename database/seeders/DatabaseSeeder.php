<?php

namespace Database\Seeders;

use App\Models\HealthInsurancePlan;
use App\Models\PriceList;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            SpecialtySeeder::class,
            DoctorSeeder::class,
            ProcedureSeeder::class,
            HealthInsurancePlanSeeder::class,
            UserSeeder::class,
            PriceListSeeder::class,
            ConsultationSeeder::class,
        ]);
    }
}
