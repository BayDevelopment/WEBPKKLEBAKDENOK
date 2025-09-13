<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdminMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'img_admin' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
                'default'    => null,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
            ],
            // ENUM untuk MySQL/MariaDB; biarkan null agar opsional
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['L', 'P'],
                'null'       => true,
                'default'    => null,
            ],
            // Lebih fleksibel daripada ENUM(['admin'])
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'default'    => 'admin',
            ],
            // Konsisten: 'active' / 'inactive'. Default 'active' agar match pengecekan controller.
            'status_account' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'null'       => false,
                'default'    => 'active',
            ],
            'password_hash' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_admin', true);
        $this->forge->addUniqueKey('username');
        $this->forge->addUniqueKey('email');

        // Tambah atribut engine/charset biar rapi
        $attributes = [
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8mb4',
            'COLLATE'         => 'utf8mb4_unicode_ci',
        ];

        $this->forge->createTable('tb_admin', true, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('tb_admin', true);
    }
}
