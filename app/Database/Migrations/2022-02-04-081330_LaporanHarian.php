<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LaporanHarian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'auto_increment' => true
            ],
            'kodeLaporan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'uraian' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'volume' => [
                'type' => 'FLOAT',
                'constraint' => 10,
                'null' => true
            ],
            'satuan' => [
                'type' => 'FLOAT',
                'constraint' => 10,
                'null' => true
            ],
            'bobot' => [
                'type' => 'FLOAT',
                'constraint' => 10,
                'null' => true
            ]
            
        ]);
        $this->forge->addUniqueKey('id','uri');
        $this->forge->createTable('laporanharians', true);
    }

    public function down()
    {
        $this->forge->dropTable('laporanharians');
    }
}
