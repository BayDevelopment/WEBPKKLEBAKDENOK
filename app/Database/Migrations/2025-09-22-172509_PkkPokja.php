<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PkkPokja extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pkkpokja' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kode'        => ['type' => 'VARCHAR', 'constraint' => 16, 'unique' => true],
            'nama'        => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'aktif'       => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'deskripsi'   => ['type' => 'TEXT', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addKey('id_pkkpokja', true);
        $this->forge->createTable('tb_pkk_pokja', true);

        // jaga-jaga pastikan InnoDB
        $this->db->query('ALTER TABLE tb_pkk_pokja ENGINE=InnoDB');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pkk_pokja', true);
    }
}
