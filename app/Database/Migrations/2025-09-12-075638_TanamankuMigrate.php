<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TanamankuMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tanamanku' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            // Identitas tanaman
            'nama_umum' => [ // contoh: Mangga
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
            ],
            'nama_latin' => [ // contoh: Mangifera indica
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],

            // Media / foto
            'foto_tanaman' => [ // simpan path/filename
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],

            // Informasi asal & deskripsi
            'asal_daerah' => [ // Asal/Daerah
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'manfaat' => [ // deskripsi manfaat
                'type' => 'TEXT',
                'null' => true,
            ],
            'keterangan' => [ // catatan tambahan
                'type' => 'TEXT',
                'null' => true,
            ],

            // Pendataan
            'tanggal_pendataan' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 1,
            ],

            // Petugas (snapshot & FK)
            'petugas_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // biar aman kalau admin dihapus
            ],
            'petugas_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true, // snapshot nama petugas saat input
            ],

            // Lokasi GPS
            'lokasi_gps_lat' => [ // -90 s/d 90
                'type'       => 'DECIMAL',
                'constraint' => '10,7',
                'null'       => true,
            ],
            'lokasi_gps_lng' => [ // -180 s/d 180
                'type'       => 'DECIMAL',
                'constraint' => '10,7',
                'null'       => true,
            ],

            // Status (opsional, kalau mau nonaktifkan data)
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
                'null'       => false,
            ],

            // Timestamps & soft deletes
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id_tanamanku', true);
        $this->forge->addKey('nama_umum');
        $this->forge->addKey('nama_latin');
        $this->forge->addKey(['lokasi_gps_lat', 'lokasi_gps_lng']);
        $this->forge->addKey('petugas_id');

        // Foreign key ke tb_admin.id_admin (pakai SET NULL jika admin dihapus)
        // Sesuaikan nama tabel & PK bila berbeda.
        $this->forge->addForeignKey('petugas_id', 'tb_admin', 'id_admin', 'SET NULL', 'SET NULL');

        // Atribut tabel
        $attributes = [
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8mb4',
            'COLLATE'         => 'utf8mb4_unicode_ci',
        ];

        $this->forge->createTable('tb_tanamanku', true, $attributes);
    }

    public function down()
    {
        // Hapus FK dulu (beberapa server perlu ini)
        if ($this->db->DBDriver === 'MySQLi') {
            $this->db->query('SET FOREIGN_KEY_CHECKS=0;');
        }
        $this->forge->dropTable('tb_tanamanku', true);
        if ($this->db->DBDriver === 'MySQLi') {
            $this->db->query('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
