<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                 => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama'               => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'slug'               => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'kategori'             => [
                'type'           => 'int',
                'constraint'     => '11',
            ],
            'harga'             => [
                'type'           => 'int',
                'constraint'     => '11',
            ],
            'img'               => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'deskripsi'               => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'created_at'         => [
                'type'           => 'DATETIME',
                'null'           => true
            ],
            'updated_at'         => [
                'type'           => 'DATETIME',
                'null'           => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
