<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsVirtualAllToTbQuizzes extends Migration
{
    public function up()
    {
        $fields = [
            'is_virtual_all' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'null'       => false,
                'after'      => 'status',
            ],
        ];
        $this->forge->addColumn('tb_quizzes', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_quizzes', 'is_virtual_all');
    }
}
