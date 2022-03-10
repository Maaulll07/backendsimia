<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Konsultan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'auto_increment' => true
            ],
            'kodeKonsultan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'namaKonsultan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('konsultans', true);
    }

    public function down()
    {
        $this->forge->dropTable('konsultans');
    }
}
