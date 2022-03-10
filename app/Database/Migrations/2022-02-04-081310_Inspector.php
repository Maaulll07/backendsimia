<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Inspector extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'auto_increment' => true
            ],
            'kodeInspector' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'namaInspector' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('inspectors',true);
    }

    public function down()
    {
        $this->forge->dropTable('inspectors');
    }
}
