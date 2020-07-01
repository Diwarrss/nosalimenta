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
          'dose_unity' => '',
          'quantity_unity' => 'Kg',
          'phytosanitary_limitation_status' => false,
          'product_status' => true,
          'dose_status' => false,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'PREPARACION DEL TERRENO',
          'dose_unity' => '',
          'quantity_unity' => 'Horas',
          'phytosanitary_limitation_status' => false,
          'product_status' => true,
          'dose_status' => false,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APLICACIÓN DE ENMIENDAS',
          'dose_unity' => '',
          'quantity_unity' => 'Kg',
          'phytosanitary_limitation_status' => false,
          'product_status' => true,
          'dose_status' => false,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'SIEMBRA',
          'dose_unity' => 'Kg',
          'quantity_unity' => 'Kg',
          'phytosanitary_limitation_status' => false,
          'product_status' => true,
          'dose_status' => true,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'FERTILIZACION',
          'dose_unity' => 'gr/Planta',
          'quantity_unity' => 'Kg',
          'phytosanitary_limitation_status' => false,
          'product_status' => true,
          'dose_status' => true,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APLICACIÓN DE INSECTICIDA',
          'dose_unity' => 'cc/Bomba 20 Litros',
          'quantity_unity' => 'Litro',
          'phytosanitary_limitation_status' => true,
          'product_status' => true,
          'dose_status' => true,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APLICACIÓN DE HERBICIDA',
          'dose_unity' => 'cc/Bomba 20 Litros',
          'quantity_unity' => 'Litro',
          'phytosanitary_limitation_status' => true,
          'product_status' => true,
          'dose_status' => true,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APLICACIÓN DE FUNGICIDA',
          'dose_unity' => 'cc/Bomba 20 Litros',
          'quantity_unity' => 'Litro',
          'phytosanitary_limitation_status' => true,
          'product_status' => true,
          'dose_status' => true,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'APORQUE',
          'dose_unity' => '',
          'quantity_unity' => '',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => false,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'DESHIERBE',
          'dose_unity' => '',
          'quantity_unity' => '',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => false,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'TUTORADO',
          'dose_unity' => '',
          'quantity_unity' => 'Cantidad',
          'phytosanitary_limitation_status' => false,
          'product_status' => true,
          'dose_status' => false,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'RIEGO',
          'dose_unity' => '',
          'quantity_unity' => 'Kg',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => false,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'PLAGAS',
          'dose_unity' => '',
          'quantity_unity' => '',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => false,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'ENFERMEDADES',
          'dose_unity' => '',
          'quantity_unity' => '',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => false,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'COSECHA EN VERDE',
          'dose_unity' => '',
          'quantity_unity' => 'Kg',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'COSECHA EN SECO',
          'dose_unity' => '',
          'quantity_unity' => 'Kg',
          'phytosanitary_limitation_status' => false,
          'product_status' => false,
          'dose_status' => false,
          'quantity_status' => true,
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'OTRAS - CUAL',
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
