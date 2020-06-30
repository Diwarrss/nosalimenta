<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
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
          'name' => 'FECHA DE ENTREGA DE SEMLLA AL BENEFICIARIO',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'PREPARACION DEL TERRENO',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APLICACIÓN DE ENMIENDAS',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'SIEMBRA',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'FERTILIZACION',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APLICACIÓN DE INSECTICIDA',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APLICACIÓN DE HERBICIDA',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APLICACIÓN DE FUNGICIDA',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APORQUE',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'DESHIERBE',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'TUTORADO',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'RIEGO',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'PLAGAS',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'ENFERMEDADES',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'COSECHA EN VERDE',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'COSECHA EN SECO',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'OTRAS - CUAL',
          'created_at' => now(),
          'updated_at' => now()
        ]
      ]);
    }
}
