<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('rols')->insert([
        'name' => 'Administrador',
        'description' => 'Super Usuario',
        'created_at' => now(),
        'updated_at' => now()
      ]);
    }
}
