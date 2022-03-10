<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KritikSaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'kontak' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'isi' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending','acc'],
                'default' => 'pending'
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('kritiksarans', true);
    }

    public function down()
    {
        $this->forge->dropTable('kritiksarans');
    }
}
