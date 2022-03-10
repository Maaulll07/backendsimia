<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataPegawai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'golongan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->addKey('nip', true);
        $this->forge->createTable('datapegawais', true);
    }

    public function down()
    {
        $this->forge->dropTable('datapegawais');
    }
}
