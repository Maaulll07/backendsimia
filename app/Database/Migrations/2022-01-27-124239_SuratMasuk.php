<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_suratMasuk' => [
                'type' => 'INT',
                'constraint' => 100,
                'auto_increment' => true
            ],
            'asalSurat' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false

            ],
            'tujuanSurat' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false

            ],
            'noSurat' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false

            ],
            'tanggalSurat' => [
                'type' => 'DATETIME',
                'null' => false

            ],
            'tanggalTerima' => [
                'type' => 'DATETIME',
                'null' => false

            ],
            'noAgenda' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false

            ],
            'sifatSurat' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false

            ],
            'perihal' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false

            ],
            'fileSurat' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false

            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['belum disposisi','sudah disposisi'],
                'default' => 'belum disposisi'
            ]
        ]);

        $this->forge->addUniqueKey('id_suratMasuk','uri');
        $this->forge->addKey('noSurat',true);
        $this->forge->createTable('suratmasuks',true);
    }

    public function down()
    {
        $this->forge->dropTable('suratmasuks');
    }
}
