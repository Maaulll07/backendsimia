<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pekerjaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 100,
                'auto_increment' => true
            ],            
            'kodePekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'jenisPekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
        ]);

        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('pekerjaans', true);
    }

    public function down()
    {
        $this->forge->dropTable('pekerjaans');
    }
}
