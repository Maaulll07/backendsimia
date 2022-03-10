<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class News extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true,

            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'file' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'author' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft','publish'],
                'default' => 'draft'
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('news', true);
    }

    public function down()
    {
        $this->forge->dropTable('news');
    }
}
