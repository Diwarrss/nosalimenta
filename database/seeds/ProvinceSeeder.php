<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('provinces')->insert([
        [
          'name' => 'CENTRO',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'LENGUPA',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'SUGAMUXI',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'GUTIERREZ',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'MARQUEZ',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'NEIRA',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'RICAURTE',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'NORTE',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'OCCIDENTE',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'ORIENTE',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'TUNDAMA',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'VALDERRAMA',
          'created_at' => now(),
          'updated_at' => now()
        ]
      ]);
    }
}
