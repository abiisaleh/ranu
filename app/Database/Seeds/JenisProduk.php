<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JenisProduk extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Kulkas',
            ],
            [
                'nama' => 'AC',
            ],
            [
                'nama' => 'Menis Cuci',
            ],
        ];

        $this->db->table('jenis')->insertBatch($data);
    }
}
