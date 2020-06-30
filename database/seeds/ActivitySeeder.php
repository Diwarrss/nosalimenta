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
          'phytosanitary_limitation_status' => false,
          'product_status' => true,
          'dose_status' => false,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'PREPARACION DEL TERRENO',
          'phytosanitary_limitation_status' => false,
          'product_status' => true,
          'dose_status' => false,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APLICACIÓN DE ENMIENDAS',
          'phytosanitary_limitation_status' => false,
          'product_status' => true,
          'dose_status' => false,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'SIEMBRA',
          'phytosanitary_limitation_status' => false,
          'product_status' => true,
          'dose_status' => true,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'FERTILIZACION',
          'phytosanitary_limitation_status' => false,
          'product_status' => true,
          'dose_status' => true,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APLICACIÓN DE INSECTICIDA',
          'phytosanitary_limitation_status' => true,
          'product_status' => true,
          'dose_status' => true,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APLICACIÓN DE HERBICIDA',
          'phytosanitary_limitation_status' => true,
          'product_status' => true,
          'dose_status' => true,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APLICACIÓN DE FUNGICIDA',
          'phytosanitary_limitation_status' => true,
          'product_status' => true,
          'dose_status' => true,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APORQUE',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => false,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'DESHIERBE',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => false,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'TUTORADO',
          'phytosanitary_limitation_status' => false,
          'product_status' => true,
          'dose_status' => false,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'RIEGO',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => false,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'PLAGAS',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => false,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'ENFERMEDADES',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => false,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'COSECHA EN VERDE',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'COSECHA EN SECO',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'OTRAS - CUAL',
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
