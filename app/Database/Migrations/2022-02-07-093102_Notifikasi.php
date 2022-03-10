<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notifikasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'auto_increment' => true
            ],
            'jenisNotifikasi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'isiNotifikasi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['belum dibaca','dibaca'],
                'default' => 'belum dibaca'
            ]
            
        ]);

        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('notifikasis', true);
    
    }

    public function down()
    {
        $this->forge->dropTable('notifikasis');
    }
}
