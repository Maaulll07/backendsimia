<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubDivisi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'kodeDivisi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'kodeSubDivisi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'namaSubDivisi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('subdivisis', true);
    }

    public function down()
    {
        $this->forge->dropTable('subdivisis');
    }
}
