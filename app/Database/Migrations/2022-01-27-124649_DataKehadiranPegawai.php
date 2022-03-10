<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataKehadiranPegawai extends Migration
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
                'constraint' => 100,
                'null' => false
            ],
            'namaPegawai' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'absen' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'keterangan' => [
                'type' => 'ENUM',
                'constraint' => ['tidak hadir','hadir','izin','dinas luar'],
                'default' => 'tidak hadir'
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('datakehadiranpegawais', true);
    }

    public function down()
    {
        $this->forge->dropTable('datakehadiranpegawais');
    }
}
