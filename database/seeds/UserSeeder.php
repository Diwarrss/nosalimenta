<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Diego Vargas',
            'email' => 'diego@soho.cl',
            'password' => Hash::make('123456789'),
            'rol_id' => '1',
            'state' => true,
            'created_at' => now(),
            'updated_at' => now()
          ]);
    }
}
