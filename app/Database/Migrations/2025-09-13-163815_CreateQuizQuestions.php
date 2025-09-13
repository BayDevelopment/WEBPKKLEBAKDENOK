<?php
#MIGRATION SOAL/PERTANYAAN

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuizQuestions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pertanyaan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'quiz_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'urutan' => [
                'type' => 'INT',
                'constraint' => 5,
                'default' => 0
            ],
            'pertanyaan' => [
                'type' => 'TEXT'
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'opsi_a' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'opsi_b' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'opsi_c' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'opsi_d' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'kunci_jawaban' => [
                'type' => "ENUM('A','B','C','D')",
                'null' => true
            ],
            'skor' => [
                'type' => 'INT',
                'constraint' => 5,
                'default' => 1
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
        $this->forge->addKey('id_pertanyaan', true);
        $this->forge->addKey('quiz_id');
        $this->forge->addKey('urutan');
        $this->forge->addForeignKey('quiz_id', 'tb_quizzes', 'id_quiz', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_quiz_questions', true, ['ENGINE' => 'InnoDB', 'DEFAULT CHARSET' => 'utf8mb4']);
    }


    public function down()
    {
        $this->forge->dropTable('tb_quiz_questions', true);
    }
}
