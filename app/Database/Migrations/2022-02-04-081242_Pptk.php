<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pptk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'auto_increment' => true
            ],
            'kodePPTK' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'namaPPTK' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('pptks', true);
    }

    public function down()
    {
        $this->forge->dropTable('pptks');
    }
}
