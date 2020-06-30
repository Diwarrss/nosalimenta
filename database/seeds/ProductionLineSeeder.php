<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('production_lines')->insert([
        [
          'name' => 'ARVEJA SANTA ISABEL',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'MAIZ  ICA V-508 PORVA',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'MAIZ HIBRIDO FNC 8134',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'FRIJOL BOLA ROJA',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'FRIJOL CERINZA',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'TRIGO TUNDAMA',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'QUINUA',
          'created_at' => now(),
          'updated_at' => now()
        ]
      ]);
    }
}
