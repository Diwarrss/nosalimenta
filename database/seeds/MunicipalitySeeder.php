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
        //province_id: CENTRO (1)
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
          'name' => 'Chiquiza',
          'province_id' => '1',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Chivatá',
          'province_id' => '1',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Motavita',
          'province_id' => '1',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Oicatá',
          'province_id' => '1',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Samacá',
          'province_id' => '1',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Siachoque',
          'province_id' => '1',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Sora',
          'province_id' => '1',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Soracá',
          'province_id' => '1',
          'phase_id' => '3',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Sotaquirá',
          'province_id' => '1',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Toca',
          'province_id' => '1',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Tunja',
          'province_id' => '1',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Tuta',
          'province_id' => '1',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        //province_id: LENGUPA (2)
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
        ],
        //province_id: SUGAMUXI (3)
        [
          'name' => 'Tota',
          'province_id' => '3',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Sogamoso',
          'province_id' => '3',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Aquitania',
          'province_id' => '3',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Firavitoba',
          'province_id' => '3',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Gameza',
          'province_id' => '3',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Tibasosa',
          'province_id' => '3',
          'phase_id' => '3',
          'created_at' => now(),
          'updated_at' => now()
        ],
        //province_id: GUTIERREZ (4)
        [
          'name' => 'Chiscas',
          'province_id' => '4',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Gûican',
          'province_id' => '4',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        //province_id: MARQUEZ (5)
        [
          'name' => 'Boyacá',
          'province_id' => '5',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Ciénega',
          'province_id' => '5',
          'phase_id' => '3',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Jenesano',
          'province_id' => '5',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Nuevo Colón',
          'province_id' => '5',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Rondon',
          'province_id' => '5',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Turmequé',
          'province_id' => '5',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Tibaná',
          'province_id' => '5',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Úmbita',
          'province_id' => '5',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        //province_id: NEIRA (6)
        [
          'name' => 'Chinavita',
          'province_id' => '6',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Garagoa',
          'province_id' => '6',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Macanal',
          'province_id' => '6',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'San Luis de Gaceno',
          'province_id' => '6',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Santa Maria',
          'province_id' => '6',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        //province_id: RICAURTE (7)
        [
          'name' => 'Moniquira',
          'province_id' => '7',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        //province_id: NORTE (8)
        [
          'name' => 'Boavita',
          'province_id' => '8',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Covarachía',
          'province_id' => '8',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'La Uvita',
          'province_id' => '8',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Sativanorte',
          'province_id' => '8',
          'phase_id' => '3',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Soatá',
          'province_id' => '8',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Tipacoque',
          'province_id' => '8',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        //province_id: OCCIDENTE (9)
        [
          'name' => 'Chiquinquira',
          'province_id' => '9',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Muzo',
          'province_id' => '9',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Otanche',
          'province_id' => '9',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Quipama',
          'province_id' => '9',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'San Miguel de Sema',
          'province_id' => '9',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Tununguá',
          'province_id' => '9',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        //province_id: ORIENTE (10)
        [
          'name' => 'Guayatá',
          'province_id' => '10',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'La capilla',
          'province_id' => '10',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Tenza',
          'province_id' => '10',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        //province_id: TUNDAMA (11)
        [
          'name' => 'Duitama',
          'province_id' => '11',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Busbanza',
          'province_id' => '11',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Paipa',
          'province_id' => '11',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Floresta',
          'province_id' => '11',
          'phase_id' => '1',
          'created_at' => now(),
          'updated_at' => now()
        ],
        //province_id: VALDERRAMA (12)
        [
          'name' => 'Socotá',
          'province_id' => '12',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
          'name' => 'Tasco',
          'province_id' => '12',
          'phase_id' => '2',
          'created_at' => now(),
          'updated_at' => now()
        ],
      ]);
    }
}
