<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kriteria extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Kapasitas',
                'bobot' => '',
                'fkJenis' => 1,
            ],
            [
                'nama' => 'Daya Listrik',
                'bobot' => '',
                'fkJenis' => 1,
            ],
            [
                'nama' => 'Harga',
                'bobot' => '',
                'fkJenis' => 1,
            ],
            [
                'nama' => 'Merek',
                'bobot' => '',
                'fkJenis' => 1,
            ],
            [
                'nama' => 'Harga',
                'bobot' => '',
                'fkJenis' => 2,
            ],
            [
                'nama' => 'Tenaga',
                'bobot' => '',
                'fkJenis' => 2,
            ],
            [
                'nama' => 'Daya Listrik',
                'bobot' => '',
                'fkJenis' => 2,
            ],
            [
                'nama' => 'Kapasitas',
                'bobot' => '',
                'fkJenis' => 2,
            ],
            [
                'nama' => 'Merek',
                'bobot' => '',
                'fkJenis' => 2,
            ],
            [
                'nama' => 'Fungsi',
                'bobot' => '',
                'fkJenis' => 3,
            ],
            [
                'nama' => 'Harga',
                'bobot' => '',
                'fkJenis' => 3,
            ],
            [
                'nama' => 'Kapasitas',
                'bobot' => '',
                'fkJenis' => 3,
            ],
            [
                'nama' => 'Ukuran',
                'bobot' => '',
                'fkJenis' => 3,
            ],
            [
                'nama' => 'Daya Listrik',
                'bobot' => '',
                'fkJenis' => 3,
            ],
            [
                'nama' => 'Merek',
                'bobot' => '',
                'fkJenis' => 3,
            ],
        ];
        $this->db->table('kriteria')->insertBatch($data);
    }
}
