<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QuizFullSeeder extends Seeder
{
    public function run()
    {
        $db  = \Config\Database::connect();
        $now = date('Y-m-d H:i:s');

        // ===== 1) Insert 5 quiz sesuai tema =====
        $rows = [
            ['judul' => 'Edukasi PKK Dasar', 'slug' => 'edukasi-pkk-dasar', 'kategori' => 'Semua', 'deskripsi' => 'Dasar-dasar PKK untuk keluarga', 'durasi_menit' => 5, 'status' => 'active'],
            ['judul' => 'Edukasi Stunting Dasar', 'slug' => 'edukasi-stunting-dasar', 'kategori' => 'Semua', 'deskripsi' => 'Kuis singkat tentang pencegahan stunting', 'durasi_menit' => 5, 'status' => 'active'],
            ['judul' => 'Edukasi Anti Narkoba', 'slug' => 'edukasi-anti-narkoba', 'kategori' => 'Semua', 'deskripsi' => 'Pencegahan penyalahgunaan narkoba', 'durasi_menit' => 5, 'status' => 'active'],
            ['judul' => 'Pola Asuh Positif', 'slug' => 'pola-asuh-positif', 'kategori' => 'Semua', 'deskripsi' => 'Mengenal pola asuh yang efektif', 'durasi_menit' => 5, 'status' => 'active'],
            ['judul' => 'Literasi Digital Dasar', 'slug' => 'literasi-digital-dasar', 'kategori' => 'Semua', 'deskripsi' => 'Dasar-dasar literasi dan keamanan digital', 'durasi_menit' => 5, 'status' => 'active'],
        ];

        $quizIds = [];
        foreach ($rows as $r) {
            $db->table('tb_quizzes')->insert($r + ['created_at' => $now, 'updated_at' => $now]);
            $quizIds[$r['slug']] = $db->insertID();
        }

        // (Opsional) quiz virtual untuk mode gabungan ALL
        // Jika ENUM kategori kamu TIDAK punya 'Semua', isi saja salah satu kategori valid (mis. 'PKK')
        $db->table('tb_quizzes')->insert([
            'judul'        => 'Semua Kategori',
            'slug'         => 'semua-kategori',
            'kategori'     => 'Semua', // atau 'Semua' jika ENUM sudah ditambah
            'deskripsi'    => 'Kumpulan soal dari semua quiz aktif',
            'durasi_menit' => 0,
            'status'       => 'active',
            'created_at'   => $now,
            'updated_at'   => $now,
        ]);
        // $quizIds['semua-kategori'] = $db->insertID(); // tidak dipakai untuk soal

        // ===== 2) Insert SOAL per quiz =====
        $soal = [];

        // PKK
        $soal[] = [
            'quiz_id' => $quizIds['edukasi-pkk-dasar'],
            'urutan' => 1,
            'pertanyaan' => 'PKK adalah singkatan dari…',
            'opsi_a' => 'Pembinaan Kesejahteraan Keluarga',
            'opsi_b' => 'Peningkatan Kualitas Kesehatan',
            'opsi_c' => 'Penggerak Kader Keluarga',
            'opsi_d' => 'Program Keluarga Kota',
            'kunci_jawaban' => 'A',
            'skor' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ];
        $soal[] = [
            'quiz_id' => $quizIds['edukasi-pkk-dasar'],
            'urutan' => 2,
            'pertanyaan' => 'Salah satu tujuan PKK adalah…',
            'opsi_a' => 'Menurunkan partisipasi masyarakat',
            'opsi_b' => 'Meningkatkan kesejahteraan keluarga',
            'opsi_c' => 'Menghapus kegiatan gotong royong',
            'opsi_d' => 'Mengurangi pendidikan',
            'kunci_jawaban' => 'B',
            'skor' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ];

        // Stunting
        $soal[] = [
            'quiz_id' => $quizIds['edukasi-stunting-dasar'],
            'urutan' => 1,
            'pertanyaan' => 'Apa kepanjangan dari ASI?',
            'opsi_a' => 'Air Susu Ibu',
            'opsi_b' => 'Air Sehat Indonesia',
            'opsi_c' => 'Asupan Sehat Ikan',
            'opsi_d' => 'Asam Susu Instan',
            'kunci_jawaban' => 'A',
            'skor' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ];
        $soal[] = [
            'quiz_id' => $quizIds['edukasi-stunting-dasar'],
            'urutan' => 2,
            'pertanyaan' => 'Usia emas pertumbuhan anak terjadi pada…',
            'opsi_a' => '0–6 bulan',
            'opsi_b' => '0–2 tahun',
            'opsi_c' => '3–5 tahun',
            'opsi_d' => '6–12 tahun',
            'kunci_jawaban' => 'B',
            'skor' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ];

        // Narkoba
        $soal[] = [
            'quiz_id' => $quizIds['edukasi-anti-narkoba'],
            'urutan' => 1,
            'pertanyaan' => 'NAPZA adalah singkatan dari…',
            'opsi_a' => 'Narkotika, Psikotropika, dan Zat Adiktif',
            'opsi_b' => 'Natrium, Pospor, Zat Aktif',
            'opsi_c' => 'Narkotika, Alkohol, Zat Asin',
            'opsi_d' => 'Narkoba, Parfum, Zat Alami',
            'kunci_jawaban' => 'A',
            'skor' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ];
        $soal[] = [
            'quiz_id' => $quizIds['edukasi-anti-narkoba'],
            'urutan' => 2,
            'pertanyaan' => 'Salah satu dampak penyalahgunaan narkoba adalah…',
            'opsi_a' => 'Prestasi meningkat',
            'opsi_b' => 'Gangguan kesehatan dan sosial',
            'opsi_c' => 'Hubungan keluarga membaik',
            'opsi_d' => 'Ekonomi keluarga stabil',
            'kunci_jawaban' => 'B',
            'skor' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ];

        // Pola Asuh
        $soal[] = [
            'quiz_id' => $quizIds['pola-asuh-positif'],
            'urutan' => 1,
            'pertanyaan' => 'Ciri pola asuh authoritative adalah…',
            'opsi_a' => 'Aturan jelas & hangat',
            'opsi_b' => 'Tanpa aturan',
            'opsi_c' => 'Kontrol ketat tanpa dialog',
            'opsi_d' => 'Anak dibiarkan bebas tanpa bimbingan',
            'kunci_jawaban' => 'A',
            'skor' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ];
        $soal[] = [
            'quiz_id' => $quizIds['pola-asuh-positif'],
            'urutan' => 2,
            'pertanyaan' => 'Komunikasi yang baik antara orang tua dan anak sebaiknya…',
            'opsi_a' => 'Satu arah',
            'opsi_b' => 'Dua arah & penuh empati',
            'opsi_c' => 'Tertutup & singkat',
            'opsi_d' => 'Hanya saat anak bermasalah',
            'kunci_jawaban' => 'B',
            'skor' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ];

        // Digitalisasi
        $soal[] = [
            'quiz_id' => $quizIds['literasi-digital-dasar'],
            'urutan' => 1,
            'pertanyaan' => 'Yang dimaksud jejak digital adalah…',
            'opsi_a' => 'Data yang tersisa dari aktivitas online',
            'opsi_b' => 'Langkah kaki di tempat kerja',
            'opsi_c' => 'Catatan sidik jari',
            'opsi_d' => 'Backup baterai perangkat',
            'kunci_jawaban' => 'A',
            'skor' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ];
        $soal[] = [
            'quiz_id' => $quizIds['literasi-digital-dasar'],
            'urutan' => 2,
            'pertanyaan' => 'Contoh perilaku aman di internet adalah…',
            'opsi_a' => 'Membagikan sandi pada teman',
            'opsi_b' => 'Menggunakan verifikasi 2 langkah',
            'opsi_c' => 'Klik semua tautan tak dikenal',
            'opsi_d' => 'Mengunggah data pribadi ke publik',
            'kunci_jawaban' => 'B',
            'skor' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ];

        // Batch insert
        $db->table('tb_quiz_questions')->insertBatch($soal);
    }
}
