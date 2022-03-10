<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jadwal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'kodeLaporan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'jadwalWaktu' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('jadwals', true);
    }

    public function down()
    {
        $this->forge->dropTable('jadwals');
    }
}
