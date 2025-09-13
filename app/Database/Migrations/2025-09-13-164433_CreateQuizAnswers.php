<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuizAnswers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jawaban' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'attempt_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true
            ],
            'pertanyaan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'jawaban' => [
                'type' => "ENUM('A','B','C','D')",
                'null' => true
            ],
            'is_benar' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ],
            'skor' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id_jawaban', true);
        $this->forge->addKey('attempt_id');
        $this->forge->addKey('pertanyaan_id');
        $this->forge->addForeignKey('attempt_id', 'tb_quiz_attempts', 'id_attempt', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pertanyaan_id', 'tb_quiz_questions', 'id_pertanyaan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_quiz_answers', true, ['ENGINE' => 'InnoDB', 'DEFAULT CHARSET' => 'utf8mb4']);
    }


    public function down()
    {
        $this->forge->dropTable('tb_quiz_answers', true);
    }
}
