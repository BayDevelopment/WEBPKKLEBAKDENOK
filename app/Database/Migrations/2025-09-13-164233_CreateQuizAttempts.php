<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuizAttempts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_attempt' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'quiz_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 64
            ], // untuk akses thanks/result tanpa login
            'mulai_sesi' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'selesai_sesi' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'durasi_detik' => [
                'type' => 'INT',
                'constraint' => 10,
                'default' => 0
            ],
            'benar' => [
                'type' => 'INT',
                'constraint' => 10,
                'default' => 0
            ],
            'salah' => [
                'type' => 'INT',
                'constraint' => 10,
                'default' => 0
            ],
            'skor_total' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true
            ],
            'user_agent' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
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
        $this->forge->addKey('id_attempt', true);
        $this->forge->addKey('quiz_id');
        $this->forge->addKey('token', false, true); // unique index
        $this->forge->addForeignKey('quiz_id', 'tb_quizzes', 'id_quiz', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_quiz_attempts', true, ['ENGINE' => 'InnoDB', 'DEFAULT CHARSET' => 'utf8mb4']);
    }


    public function down()
    {
        $this->forge->dropTable('tb_quiz_attempts', true);
    }
}
