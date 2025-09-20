<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPertanyaan;
use App\Models\QuizModel;
use App\Models\TanamankuModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    protected $ModelTanamanku;
    protected $Quizes;
    protected $QuizAnswers;
    protected $QuizAttempts;
    protected $QuizQuetions;
    protected $QuizModel;
    public function __construct()
    {
        $this->ModelTanamanku = new TanamankuModel();
        $this->QuizModel = new QuizModel();
    }
    public function DashboardAdmin()
    {
        $data = [
            'title' => 'TP PKK | Dashboard Admin',
            'sub_judul' => 'Dashboard'
        ];
        return view('pages/admin/dashboard_admin', $data);
    }
    public function page_tanamanku()
    {
        $req = $this->request;

        // Ambil parameter GET
        $q      = trim((string) $req->getGet('q'));
        $status = strtolower(trim((string) $req->getGet('status'))); // 'active'/'inactive' atau 'aktif'/'nonaktif'

        $model = $this->ModelTanamanku;

        // Urutan list (pilih kolom yang ada di tabelmu)
        $model->orderBy('created_at', 'DESC');

        // ====== Filter utk LIST ======
        if ($q !== '') {
            $model->groupStart()
                ->like('nama_umum', $q)
                ->orLike('nama_latin', $q)
                ->orLike('asal_daerah', $q)
                ->orLike('manfaat', $q)
                ->orLike('keterangan', $q)
                ->groupEnd();
        }
        if ($status !== '') {
            $map = ['aktif' => 'active', 'nonaktif' => 'inactive'];
            $statusDb = $map[$status] ?? $status;
            if (in_array($statusDb, ['active', 'inactive'], true)) {
                $model->where('status', $statusDb);
            }
        }

        $listData = $model->findAll();

        // ====== Filter utk CHART (pakai builder baru) ======
        $b = $this->ModelTanamanku->builder();
        $b->select('nama_umum, SUM(jumlah) AS total');

        if ($q !== '') {
            $b->groupStart()
                ->like('nama_umum', $q)
                ->orLike('nama_latin', $q)
                ->orLike('asal_daerah', $q)
                ->orLike('manfaat', $q)
                ->orLike('keterangan', $q)
                ->groupEnd();
        }
        if ($status !== '') {
            $map = ['aktif' => 'active', 'nonaktif' => 'inactive'];
            $statusDb = $map[$status] ?? $status;
            if (in_array($statusDb, ['active', 'inactive'], true)) {
                $b->where('status', $statusDb);
            }
        }

        // Grouping & urutkan terbesar, ambil top 10 biar rapi (ubah sesuai kebutuhan)
        $b->groupBy('nama_umum')->orderBy('total', 'DESC')->limit(10);
        $rows = $b->get()->getResultArray();

        $chart_pill = [
            'labels' => array_column($rows, 'nama_umum'),
            'data'   => array_map('intval', array_column($rows, 'total')),
        ];

        $data = [
            'title'       => 'TP PKK | Tanamanku',
            'sub_judul'   => 'Tanamanku',
            'filters'     => ['q' => $q, 'status' => $status],
            'd_tanaman'   => $listData,         // sesuaikan dg variabel di view kamu
            'chart_pill'  => $chart_pill,       // <-- kirim ke view
        ];

        return view('pages/admin/data-tanaman', $data);
    }
    public function page_quiz()
    {
        // --- daftar quiz untuk tabel ---
        $quizzes = $this->QuizModel
            ->select('id_quiz, judul, slug, kategori, deskripsi, durasi_menit, status, is_virtual_all, thumbnail, created_at, updated_at')
            ->orderBy('created_at')
            ->findAll();

        // --- siapkan kategori (urut alfabet & dipakai default 0 kalau belum ada soal) ---
        $allCategories = $this->QuizModel
            ->select('kategori')
            ->groupBy('kategori')
            ->orderBy('kategori', 'ASC')
            ->findColumn('kategori');

        if (!$allCategories) {
            $allCategories = []; // fallback: tidak ada kategori
        }

        // --- hitung jumlah soal per kategori via Model (tanpa $db) ---
        $pertanyaanModel = new ModelPertanyaan();
        $rows = $pertanyaanModel
            ->select('tb_quizzes.kategori, COUNT(tb_quiz_questions.id_pertanyaan) AS total_soal')
            ->join('tb_quizzes', 'tb_quizzes.id_quiz = tb_quiz_questions.quiz_id', 'inner')
            // ->where('tb_quizzes.status', 'active') // kalau hanya ingin dari quiz aktif
            ->groupBy('tb_quizzes.kategori')
            ->orderBy('tb_quizzes.kategori', 'ASC')
            ->findAll();

        // map kategori -> total, isi 0 untuk yang tidak ada di hasil
        $map = array_fill_keys($allCategories, 0);
        foreach ($rows as $r) {
            $cat = $r['kategori'] ?? '';
            if ($cat !== '') $map[$cat] = (int) $r['total_soal'];
        }

        // data untuk Chart.js
        $chartLabels = array_keys($map);
        $chartData   = array_values($map);

        $data = [
            'title'        => 'TP PKK | Quiz',
            'sub_judul'    => 'Quiz',
            'quizzes'      => $quizzes,
            'chart_labels' => $chartLabels, // kirim ke view
            'chart_data'   => $chartData,   // kirim ke view
            'validation'   => \Config\Services::validation(),
        ];

        return view('pages/admin/data-quiz', $data);
    }
}
