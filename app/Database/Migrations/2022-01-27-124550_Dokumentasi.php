<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dokumentasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 100,
                'auto_increment' => true
            ],
            'namaProyek' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'kecamatan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'kelurahan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'namaFile' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'tipeDokumen' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'tanggal' => [
                'type' => 'DATETIME',
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('dokumentasis', true);
    }

    public function down()
    {
        $this->forge->dropTable('dokumentasis');
    }
}
