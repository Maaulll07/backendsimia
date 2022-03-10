<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Proyek extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'namaProyek' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'lokasiProyek' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'tanggalProyek' => [
                'type' => 'DATE',                
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
            'nomorKontrak' => [
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
            'progres' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending','berjalan','selesai'],
                'default' => 'pending'
            ]
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('proyeks', true);
    }

    public function down()
    {
        $this->forge->dropTable('proyeks');
    }
}
