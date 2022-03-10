<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kecamatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'kodeKecamatan' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false
            ],
            'namaKecamatan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]

        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->addKey('kodeKecamatan', true);
        $this->forge->createTable('kecamatans', true);
    }

    public function down()
    {
        $this->forge->dropTable('kecamatans');
    }
}
