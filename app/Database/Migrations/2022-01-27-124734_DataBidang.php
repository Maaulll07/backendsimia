<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataBidang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 100,
                'auto_increment' => true
            ],
            'kodeBidang' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'namaBidang' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id', 'uri');
        $this->forge->createTable('databidangs', true);
    }

    public function down()
    {
        $this->forge->dropTable('databidangs');
    }
}
