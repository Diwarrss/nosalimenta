<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('municipalities')->insert([
        [
          'name' => 'Cómbita',
          'province_id' => '1',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Cucaita',
          'province_id' => '1',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Berbeo',
          'province_id' => '2',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Cucaita',
          'province_id' => '2',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ]
      ]);
    }
}
