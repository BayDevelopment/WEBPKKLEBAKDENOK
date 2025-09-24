<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PendaftaranMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pendaftaran' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_pkkpokja'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_lengkap'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'nik'            => ['type' => 'VARCHAR', 'constraint' => 16],
            'alamat'         => ['type' => 'VARCHAR', 'constraint' => 200],
            'no_hp'          => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id_pendaftaran', true);
        $this->forge->addKey('id_pkkpokja'); // index untuk FK
        $this->forge->addForeignKey(
            'id_pkkpokja',
            'tb_pkk_pokja',
            'id_pkkpokja',
            'CASCADE',
            'CASCADE',
            'fk_pendaftaran_pokja'
        );

        $this->forge->createTable('tb_pkk_pendaftaran', true);
        $this->db->query('ALTER TABLE tb_pkk_pendaftaran ENGINE=InnoDB');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('tb_pkk_pendaftaran', 'fk_pendaftaran_pokja');
        $this->forge->dropTable('tb_pkk_pendaftaran', true);
    }
}
