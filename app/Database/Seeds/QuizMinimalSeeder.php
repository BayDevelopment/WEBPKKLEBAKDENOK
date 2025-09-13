<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QuizMinimalSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // Pastikan ENUM kategori sudah menambah 'Semua' (opsi 1),
        // atau biarkan saja isi kategori apa pun (opsi 2) karena hanya label.
        $this->db->table('tb_quizzes')->insert([
            'judul'        => 'Semua Kategori',
            'slug'         => 'semua-kategori',
            'kategori'     => 'Semua',   // atau 'PKK' jika ENUM kamu tidak ada 'Semua'
            'deskripsi'    => 'Kumpulan soal dari semua quiz aktif',
            'durasi_menit' => 0,
            'status'       => 'active',
            'created_at'   => $now,
            'updated_at'   => $now,
        ]);
    }
}
