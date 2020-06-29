<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('phases')->insert([
        [
          'name' => 'Primera fase',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Segunda fase',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Primera y segunda fase',
          'created_at' => now(),
          'updated_at' => now()
        ]
      ]);
    }
}
