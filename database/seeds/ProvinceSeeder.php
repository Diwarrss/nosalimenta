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
          'name' => 'Centro',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Lengupa',
          'created_at' => now(),
          'updated_at' => now()
        ]
      ]);
    }
}
