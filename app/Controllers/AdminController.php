<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TanamankuModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    protected $ModelTanamanku;
    protected $Quizes;
    protected $QuizAnswers;
    protected $QuizAttempts;
    protected $QuizQuetions;
    public function __construct()
    {
        $this->ModelTanamanku = new TanamankuModel();
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
        $data = [
            'title' => 'TP PKK | Quiz',
            'sub_judul' => 'Quiz'
        ];
        return view('pages/admin/data-quiz', $data);
    }
}
