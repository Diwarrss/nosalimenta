<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddAvtivity2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('activities')->insert([
        [
          'name' => 'INFORMACIÓN SOCIOECONÓMICA',
          'dose_unity' => '',
          'quantity_unity' => '',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => false,
          'created_at' => now(),
          'updated_at' => now()
        ]
      ]);
    }
}
