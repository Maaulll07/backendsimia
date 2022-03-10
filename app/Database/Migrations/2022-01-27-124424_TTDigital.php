<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TTDigital extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 100,
                'auto_increment' => true
            ],
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'peruntukan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'noSurat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'tanggalPembuatan' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('ttdigitals', true);
    }

    public function down()
    {
        $this->forge->dropTable('ttdigitals');
    }
}
