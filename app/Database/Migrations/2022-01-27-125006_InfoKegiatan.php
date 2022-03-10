<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InfoKegiatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 100,
                'auto_increment' => true
            ],
            'namaProyek' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'tanggalProyek' => [
                'type' => 'DATE',
                'null' => false
            ],
            'kodePekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'klpd' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'kodeKonsultan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'kodeKontraktor' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'subProyek' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'nilaiKontrak' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'kodeLelang' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'tahunAnggaran' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'kodePPK' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'kodePPTK' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'kodeInspector' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'kodeLaporan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'noKontrak' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending','berjalan','selesai'],
                'default' => 'pending'
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('infokegiatans', true);
    }

    public function down()
    {
        $this->forge->dropTable('infokegiatans');
    }
}
