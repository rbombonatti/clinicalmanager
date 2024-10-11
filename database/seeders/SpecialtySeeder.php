<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specialties')->insert([
            ['title' => 'Retina Clínica'],
            ['title' => 'Retina Cirúrgica'],
            ['title' => 'Córnea'],
            ['title' => 'Glaucoma'],
            ['title' => 'Catarata'],
            ['title' => 'Oftalmologia Pediátrica'],
            ['title' => 'Neuroftalmologia'],
            ['title' => 'Plástica Ocular'],
            ['title' => 'Lentes de Contato'],
            ['title' => 'Oncologia Ocular'],
            ['title' => 'Uveítes'],
            ['title' => 'Cirurgia Refrativa'],
            ['title' => 'Estrabismo'],
            ['title' => 'Órbita'],
            ['title' => 'Angiografia Ocular'],
            ['title' => 'Oculoplastia'],
            ['title' => 'Oftalmogenética'],
            ['title' => 'Transplante de Córnea']
        ]);
    }
}
