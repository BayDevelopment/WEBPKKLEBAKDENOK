<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AttemptModel;
use App\Models\ModelPertanyaan;
use App\Models\ModelPkk;
use App\Models\QuestionModel;
use App\Models\QuizModel;
use App\Models\RekrutModel;
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
    protected $ModelPokja;
    protected $ModelRekrut;
    public function __construct()
    {
        $this->ModelTanamanku = new TanamankuModel();
        $this->QuizModel = new QuizModel();
        $this->QuizQuetions = new QuestionModel();
        $this->QuizAttempts = new AttemptModel();
        $this->ModelPokja = new ModelPkk();
        $this->ModelRekrut = new RekrutModel();
    }

    public function DashboardAdmin()
    {
        // KPI cepat
        $jumlah_tanaman = $this->ModelTanamanku->countAll();

        // === Chart Tanamanku: SUM(jumlah) per nama_umum (Top 10) ===
        $bTanaman = $this->ModelTanamanku->builder();
        $rowsT = $bTanaman->select('nama_umum, SUM(jumlah) AS total', false)
            ->groupBy('nama_umum')
            ->orderBy('total', 'DESC')
            ->limit(10)
            ->get()->getResultArray();

        $chart_tanaman = [
            'labels' => array_column($rowsT, 'nama_umum'),
            'data'   => array_map('intval', array_column($rowsT, 'total')),
        ];

        // === Chart Quiz + List Soal per Kategori (ACTIVE quiz only) ===
        $db       = \Config\Database::connect();

        // Tabel pertanyaan (model kamu)
        $tableQ  = $this->QuizQuetions->getTable();
        $qFields = $db->getFieldNames($tableQ);

        // PK pertanyaan
        $qidCol = in_array('id_pertanyaan', $qFields, true) ? 'id_pertanyaan'
            : (in_array('id', $qFields, true) ? 'id' : null);
        if ($qidCol === null) throw new \RuntimeException("PK pertanyaan (id_pertanyaan/id) tidak ada di $tableQ");
        if (!in_array('quiz_id', $qFields, true)) throw new \RuntimeException("Kolom quiz_id tidak ada di $tableQ");

        // Tabel quiz/kategori (punya status + (kategori|judul))
        $tables    = $db->listTables();
        $quizTable = null;
        $pFields = [];
        foreach ($tables as $t) {
            if ($t === $tableQ) continue;
            try {
                $f = $db->getFieldNames($t);
            } catch (\Throwable $e) {
                continue;
            }
            if (in_array('status', $f, true) && (in_array('kategori', $f, true) || in_array('judul', $f, true))) {
                $quizTable = $t;
                $pFields = $f;
                break;
            }
        }
        if (!$quizTable) throw new \RuntimeException('Tabel quiz/kategori tidak ditemukan (butuh kolom: status + kategori/judul).');

        $pidCol = in_array('id_quiz', $pFields, true) ? 'id_quiz'
            : (in_array('id', $pFields, true) ? 'id' : null);
        if ($pidCol === null) throw new \RuntimeException("PK quiz (id_quiz/id) tidak ada di $quizTable");

        // soft delete flags
        $qHasDeleted = in_array('deleted_at', $qFields, true);
        $pHasDeleted = in_array('deleted_at', $pFields, true);

        // Label kategori dari tabel quiz
        $labelExpr = "COALESCE(NULLIF(TRIM(p.kategori),''), NULLIF(TRIM(p.judul),''), 'Tanpa Kategori')";

        // A) Hitung jumlah PERTANYAAN per kategori (count dari tabel pertanyaan saja)
        $bCount = $db->table("$tableQ q");
        $bCount->select("$labelExpr AS kat", false)
            ->selectCount("q.$qidCol", 'total')
            ->join("$quizTable p", "p.$pidCol = q.quiz_id", 'inner')
            ->where("LOWER(TRIM(IFNULL(p.status,''))) = 'active'", null, false);
        if ($qHasDeleted) $bCount->where('q.deleted_at IS NULL', null, false);
        if ($pHasDeleted) $bCount->where('p.deleted_at IS NULL', null, false);

        $rowsActive = $bCount->groupBy('kat')
            ->orderBy('total', 'DESC')
            ->get()->getResultArray();

        $jumlah_soal_quiz = array_sum(array_map(static fn($r) => (int)$r['total'], $rowsActive));
        $chart_quiz = [
            'labels' => array_column($rowsActive, 'kat'),
            'data'   => array_map('intval', array_column($rowsActive, 'total')),
        ];

        // B) Ambil daftar soal per kategori (ACTIVE quiz only), tanpa urutan; exclude deleted
        $bList = $db->table("$tableQ q");
        $bList->select("$labelExpr AS kat", false)
            ->select("q.$qidCol AS id_pertanyaan, q.quiz_id, q.pertanyaan, q.gambar, q.opsi_a, q.opsi_b, q.opsi_c, q.opsi_d, q.kunci_jawaban, q.skor")
            ->join("$quizTable p", "p.$pidCol = q.quiz_id", 'inner')
            ->where("LOWER(TRIM(IFNULL(p.status,''))) = 'active'", null, false);
        if ($qHasDeleted) $bList->where('q.deleted_at IS NULL', null, false);
        if ($pHasDeleted) $bList->where('p.deleted_at IS NULL', null, false);
        $bList->orderBy('kat', 'ASC')
            ->orderBy("q.$qidCol", 'ASC');

        $rowsAll = $bList->get()->getResultArray();

        // Grouping di PHP
        $soal_per_kategori = [];
        foreach ($rowsAll as $r) {
            $label = $r['kat'] ?? 'Tanpa Kategori';
            unset($r['kat']);
            $soal_per_kategori[$label][] = $r;
        }

        // Urutkan kategori mengikuti chart (jumlah desc)
        if (!empty($chart_quiz['labels'])) {
            $ordered = [];
            foreach ($chart_quiz['labels'] as $lbl) if (isset($soal_per_kategori[$lbl])) $ordered[$lbl] = $soal_per_kategori[$lbl];
            foreach ($soal_per_kategori as $lbl => $rows) if (!isset($ordered[$lbl])) $ordered[$lbl] = $rows;
            $soal_per_kategori = $ordered;
        }

        $data = [
            'title'                 => 'TP PKK | Dashboard Admin',
            'sub_judul'             => 'Dashboard',
            'jumlah_tanaman'        => $jumlah_tanaman,
            'jumlah_soal_quiz'      => $jumlah_soal_quiz,
            'chart_tanaman'         => $chart_tanaman,
            'chart_quiz'            => $chart_quiz,
            'soal_per_kategori'     => $soal_per_kategori,
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

    public function page_rekrutmen()
    {
        $data = [
            'title' => 'TP PKK | Pendaftaran Gabung Bersama Kami',
            'sub_judul' => 'Data Rekrutmen',
            'd_rekrut' => $this->ModelRekrut->findAll(),
            'd_pokja' => $this->ModelPokja->findAll()
        ];
        return view('pages/admin/pendaftaran', $data);
    }
}
