<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratKeluar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_suratKeluar' => [
                'type' => 'INT',
                'constraint' => 100,
                'auto_increment' => true
            ],
            'noAgenda' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false

            ],
            'noSurat' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'tanggalKirim' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'tujuanSurat' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'untukPengguna' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'isiRingkasan' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'fileSurat' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft','kirim'],
                'default' => 'draft'
            ]

        ]);
        $this->forge->addUniqueKey('id_suratKeluar','uri');
        $this->forge->addKey('noSurat', true);
        $this->forge->createTable('suratkeluars', true);
    }

    public function down()
    {
        $this->forge->dropTable('suratkeluars');
    }
}
