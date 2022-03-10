<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LaporanMasyarakat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 100,
                'auto_increment' => true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'isi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'kontak' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'tanggal' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending','acc'],
                'default' => 'pending'
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('laporanmasyarakats', true);
    }

    public function down()
    {
        $this->forge->dropTable('laporanmasyarakats');
    }
}
