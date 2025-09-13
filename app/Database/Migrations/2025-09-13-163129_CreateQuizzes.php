<?php
#MIGRATION INFORMASI UNTUK SOAL/PERTANYAAN SETIAP KUIS

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuizzes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_quiz' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 220,
                'null' => true
            ],
            'kategori' => [
                'type' => "ENUM('PKK','Stunting','Narkoba','Pola Asuh','Digitalisasi','Semua')",
                'null' => false,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'durasi_menit' => [
                'type' => 'INT',
                'constraint' => 5,
                'default' => 0
            ], // 0 = tanpa timer
            'status' => [
                'type' => "ENUM('active','inactive')",
                'default' => 'inactive'
            ],
            'thumbnail' => [
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
        $this->forge->addKey('id_quiz', true);
        $this->forge->addKey('kategori');
        $this->forge->addKey('status');
        $this->forge->addKey('slug', false, true); // unique index
        $this->forge->createTable('tb_quizzes', true, ['ENGINE' => 'InnoDB', 'DEFAULT CHARSET' => 'utf8mb4']);
    }


    public function down()
    {
        $this->forge->dropTable('tb_quizzes', true);
    }
}
