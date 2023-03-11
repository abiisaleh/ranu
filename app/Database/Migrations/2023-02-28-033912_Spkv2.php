<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Spkv2 extends Migration
{
    public function up()
    {
        //jenis
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 3,
                'auto_increment'=> true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jenis');

        //kriteria
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 3,
                'auto_increment'=> true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'bobot' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
            'fkJenis' => [
                'type' => 'INT',
                'constraint' => 5
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('fkJenis', 'jenis', 'id', 'NULL', 'CASCADE');
        $this->forge->createTable('kriteria');

        //subkriteria
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 3,
                'auto_increment' => true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'nilai' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
            'fkKriteria' => [
                'type' => 'INT',
                'constraint' => 3
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('fkKriteria', 'kriteria', 'id', 'NULL', 'CASCADE');
        $this->forge->createTable('subkriteria');

        //produk
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 3,
                'auto_increment'=> true
            ],
            'merek' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'model' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 9,
            ],
            'fkJenis' => [
                'type' => 'INT',
                'constraint' => 3
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('fkJenis', 'jenis', 'id', 'NULL', 'CASCADE');
        $this->forge->createTable('produk');
        
        //fitur
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 3,
                'auto_increment'=> true
            ],
            'nilai' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'fkProduk' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'fkKriteria' => [
                'type' => 'INT',
                'constraint' => 3
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('fkProduk', 'produk', 'id', 'NULL', 'CASCADE');
        $this->forge->addForeignKey('fkKriteria', 'kriteria', 'id', 'NULL', 'CASCADE');
        $this->forge->createTable('fitur');

        //konsumen
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 3,
                'auto_increment'=> true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'telp' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'tanggalLahir' => [
                'type' => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('konsumen');

        //pilihan
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 3,
                'auto_increment'=> true
            ],
            'fkKonsumen' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'fkProduk' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'fkSubkriteria' => [
                'type' => 'INT',
                'constraint' => 3
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('fkKonsumen', 'konsumen', 'id', 'NULL', 'CASCADE');
        $this->forge->addForeignKey('fkProduk', 'produk', 'id', 'NULL', 'CASCADE');
        $this->forge->addForeignKey('fkSubkriteria', 'subkriteria', 'id', 'NULL', 'CASCADE');
        $this->forge->createTable('piihan');

        //pesanan
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 3,
                'auto_increment'=> true
            ],
            'tanggal' => [
                'type' => 'DATETIME',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'fkProduk' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'fkKonsumen' => [
                'type' => 'INT',
                'constraint' => 3
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('fkProduk', 'produk', 'id', 'NULL', 'CASCADE');
        $this->forge->addForeignKey('fkKonsumen', 'konsumen', 'id', 'NULL', 'CASCADE');
        $this->forge->createTable('pesanan');
    }

    public function down()
    {
        $this->forge->dropTable('jenis');
        $this->forge->dropTable('kriteria');
        $this->forge->dropTable('subkriteria');
        $this->forge->dropTable('produk');
        $this->forge->dropTable('fitur');
        $this->forge->dropTable('konsumen');
        $this->forge->dropTable('pilihan');
        $this->forge->dropTable('pesanan');
    }
}
