<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelurahan extends Migration
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
                'constraint' => 100,
                'null' => false
            ],
            'kodeKelurahan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'namaKelurahan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->addKey('kodeKelurahan', true);
        $this->forge->createTable('kelurahans',true);
    }

    public function down()
    {
        $this->forge->dropTable('kelurahans');
    }
}
