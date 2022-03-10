<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ppk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'auto_increment' => true
            ],
            'kodePPK' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'namaPPK' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('ppks', true);
    }

    public function down()
    {
        $this->forge->dropTable('ppks');
    }
}
