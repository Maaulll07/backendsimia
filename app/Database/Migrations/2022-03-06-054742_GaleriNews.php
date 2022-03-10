<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GaleriNews extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 10,
                    'auto_increment' => true,

                ],
                'judul' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => false
                ],
                'namaFile' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => false
                ],
                'created DATETIME DEFAULT CURRENT_TIMESTAMP',
                'user' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => false
                ] 
            ]
        );

        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('galerinews', true);
    }

    public function down()
    {
        $this->forge->dropTable('galerinews');
    }
}
