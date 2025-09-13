<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MarkAllQuizSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Cari berdasarkan slug ATAU judul, lalu tandai.
        $row = $db->table('tb_quizzes')->where('slug', 'semua-kategori')->get()->getRowArray();
        if (!$row) {
            $row = $db->table('tb_quizzes')->where('judul', 'Semua Kategori')->get()->getRowArray();
        }

        if ($row) {
            $db->table('tb_quizzes')
                ->where('id_quiz', $row['id_quiz'])
                ->update(['is_virtual_all' => 1, 'status' => 'active', 'deleted_at' => null, 'updated_at' => date('Y-m-d H:i:s')]);
        } else {
            // Belum ada? Buat baru (kategori isi salah satu nilai ENUM yang valid kalau 'Semua' belum ada)
            $db->table('tb_quizzes')->insert([
                'judul'        => 'Semua Kategori',
                'slug'         => 'semua-kategori',
                'kategori'     => 'PKK',   // atau 'Semua' jika ENUM sudah ditambah
                'deskripsi'    => 'Kumpulan soal dari semua quiz aktif',
                'durasi_menit' => 0,
                'status'       => 'active',
                'is_virtual_all' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
