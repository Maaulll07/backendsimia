<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kontraktor extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'auto_increment' => true
            ],
            'kodeKontraktor' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'namaKontraktor' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('kontraktors', true);
    }

    public function down()
    {
        $this->forge->dropTable('kontraktors');
    }
}
