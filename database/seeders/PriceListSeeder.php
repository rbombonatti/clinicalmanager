<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('price_lists')->insert([
            'title' => 'Lista de Preços 2024',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'active' => true,
        ]);
    }
}
