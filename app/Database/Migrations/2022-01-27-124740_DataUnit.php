<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataUnit extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 100,
                'auto_increment' => true
            ],
            'kodeUnit' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'kodeBidang' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'namaUnit' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id', 'uri');
        $this->forge->createTable('dataunits', true);
    }

    public function down()
    {
        $this->forge->dropTable('dataunits');
    }
}
