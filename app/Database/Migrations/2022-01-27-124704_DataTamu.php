<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataTamu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 100,
                'auto_increment' => true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'tandaPengenal' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'tanggalDatang' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'keperluan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
            
        ]);
        $this->forge->addUniqueKey('id','uri');       
        $this->forge->createTable('datatamus', true);
    }

    public function down()
    {
        $this->forge->dropTable('datatamus');
    }
}
