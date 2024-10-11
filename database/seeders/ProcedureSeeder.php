<?php

namespace Database\Seeders;

use App\Models\Procedure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $procedures = [
            'Bio E Micro',
            'Biometria',
           'Campo',
           'Campo Paqui',
           'Curva',
           'Fotocoagulação',
           'Microscopia',
           'Oct',
           'Paquimetria',
           'Pentacam',
           'Topografia',
           'Ultrassonografia',
        ];

        foreach ($procedures as $procedure) {
            DB::table('procedures')->insert([
                'title' => $procedure,
            ]);
        }
    }
}
