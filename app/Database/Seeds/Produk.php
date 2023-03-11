<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Produk extends Seeder
{
    public function run()
    {
        $data = [
            'merek' => 'Samsung',
            'model' => 'S001',
            'harga' => '2500000',
            'fkjenis' => 1,
        ];
        $this->db->table('produk')->insert($data);
    }
}
