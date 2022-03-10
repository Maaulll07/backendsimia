<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTTDigital extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ttdigitals',[
            'namaDokumen VARCHAR(100)'

        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('ttdigitals','namaDokumen');
    }
}
