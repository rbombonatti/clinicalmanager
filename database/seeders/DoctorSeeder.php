<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert([
            [
                'first_name' => 'Doutora',
                'last_name' => 'A',
                'role_id' => 1
            ],
            [
                'first_name' => 'Doutor',
                'last_name' => 'B',
                'role_id' => 1
            ]
        ]);
    }
}
