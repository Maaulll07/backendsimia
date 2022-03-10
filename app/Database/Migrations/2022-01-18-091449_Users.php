<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'password' =>[
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'level' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'createdBy' =>[
                'type' => 'TEXT',
                'null' => false
            ]
        ]);
        $this->forge->addKey('username', true);
        $this->forge->addUniquekey('id_user','uri');
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
