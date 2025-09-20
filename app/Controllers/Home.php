<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AnswerModel;
use App\Models\AttemptModel;
use App\Models\QuestionModel;
use App\Models\QuizModel;
use App\Models\TanamankuModel;

class Home extends BaseController
{
    protected $ModelTanamanku;
    protected $ModelAdmin;
    protected $Quizes;
    protected $QuizQuetions;
    protected $QuizAttempts;
    protected $QuizAnswers;

    private function getAllQuiz(): ?array
    {
        // Ambil baris virtual ALL; kalau ada yang soft-deleted, otomatis dibangunkan lagi.
        $row = $this->Quizes->withDeleted()
            ->where('is_virtual_all', 1)
            ->orderBy('id_quiz', 'DESC') // kalau ada 2, ambil yang terbaru
            ->first();

        if ($row && !empty($row['deleted_at'])) {
            $this->Quizes->update($row['id_quiz'], ['deleted_at' => null, 'status' => 'active']);
            $row['deleted_at'] = null;
            $row['status']     = 'active';
        }
        return $row;
    }


    public function __construct()
    {
        $this->ModelTanamanku = new TanamankuModel();
        $this->ModelAdmin = new AdminModel();
        $this->Quizes = new QuizModel();
        $this->QuizQuetions = new QuestionModel();
        $this->QuizAttempts = new AttemptModel();
        $this->QuizAnswers  = new AnswerModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Welcome | PKK Kelurahan Lebak Denok',
            'navLink' => 'Beranda' //untuk navlink 
        ];
        return view('home', $data);
    }
    public function TentangKami()
    {
        $data = [
            'title' => 'Tentang Kami | PKK Kelurahan Lebak Denok',
            'navLink' => 'Tentang Kami' //untuk navlink 
        ];
        return view('pages/public/tentang-kami', $data);
    }
    public function Pendahuluan()
    {
        $data = [
            'title' => 'Pendahuluan | PKK Kelurahan Lebak Denok',
            'navLink' => 'Pendahuluan' //untuk navlink 
        ];
        return view('pages/public/pendahuluan', $data);
    }
    public function MaksudDanTujuan()
    {
        $data = [
            'title' => 'Maksud dan Tujuan | PKK Kelurahan Lebak Denok',
            'navLink' => 'MaksudTujuan' //untuk navlink 
        ];
        return view('pages/public/maksud-tujuan', $data);
    }
    public function VisiMisi()
    {
        $data = [
            'title' => 'Visi, Misi & Motto | PKK Kelurahan Lebak Denok',
            'navLink' => 'VisiMisi' //untuk navlink 
        ];
        return view('pages/public/visi-misi', $data);
    }
    public function KondisiWilayah()
    {
        $data = [
            'title' => 'Kondisi Wilayah | PKK Kelurahan Lebak Denok',
            'navLink' => 'KondisiWilayah' //untuk navlink 
        ];
        return view('pages/public/kondisi-wilayah', $data);
    }

    public function Tanamanku()
    {
        $model   = new TanamankuModel();

        // Query string opsional: ?q=kata+apa&per_page=12
        $q       = trim((string) $this->request->getGet('q'));
        $perPage = (int) ($this->request->getGet('per_page') ?? 12);
        if ($perPage < 1 || $perPage > 100) $perPage = 12; // guard sederhana

        // Builder dasar: hanya status active, terbaru duluan
        $builder = $model->select('id_tanamanku, nama_umum, nama_latin, asal_daerah, foto_tanaman, manfaat, tanggal_pendataan, status')
            ->where('status', 'active')
            ->orderBy('tanggal_pendataan', 'DESC')
            ->asArray();

        // Pencarian sederhana di beberapa kolom
        if ($q !== '') {
            $builder->groupStart()
                ->like('nama_umum', $q)
                ->orLike('nama_latin', $q)
                ->orLike('asal_daerah', $q)
                ->orLike('manfaat', $q)
                ->groupEnd();
        }

        // Paginate
        $dataTanaman = $builder->paginate($perPage, 'tanaman'); // 'tanaman' = nama group pager opsional
        $pager       = $model->pager;

        $data = [
            'title'      => 'Tanamanku | PKK Kelurahan Lebak Denok',
            'navLink'    => 'Tanamanku',
            'd_tanaman'  => $dataTanaman, // kirim ke view
            'pager'      => $pager,       // untuk render pagination
            'q'          => $q,           // biar input search bisa mempertahankan nilai
            'per_page'   => $perPage,
        ];

        return view('pages/public/tanamanku', $data);
    }


    public function DetailTanamanku(int $id)
    {
        $model = new TanamankuModel();

        // Ambil 1 baris, hanya yang active
        $row = $model->select('id_tanamanku,nama_umum,nama_latin,asal_daerah,manfaat,keterangan,foto_tanaman,petugas_nama,tanggal_pendataan,jumlah,lokasi_gps_lat,lokasi_gps_lng,status')
            ->where('id_tanamanku', $id)
            ->where('status', 'active')
            ->first();

        if (!$row) {
            // SweetAlert lalu balik ke halaman list
            return redirect()
                ->to(site_url('tanamanku'))
                ->with('sweet_error', 'Data Tanamanku tidak ditemukan atau sudah diarsipkan.');
        }

        // (opsional) ambil 6 data lain sebagai "tanaman terkait"
        // Ambil data terkait + pastikan array
        $related = $model->select('id_tanamanku, nama_umum, nama_latin, foto_tanaman')
            ->where('status', 'active')
            ->where('id_tanamanku !=', $row['id_tanamanku'])
            ->orderBy('tanggal_pendataan', 'DESC')
            ->limit(6)
            ->asArray()
            ->find();


        $data = [
            'title'     => 'Detail Tanamanku | PKK Kelurahan Lebak Denok',
            'navLink'   => 'Tanamanku',
            'row'       => $row,      // data utama untuk detail
            'related'   => $related,  // opsional, untuk grid "lainnya"
        ];

        return view('pages/public/detail-tanamanku', $data);
    }
    public function quisList()
    {
        helper(['text']);

        $model   = $this->Quizes; // Model Quiz kamu
        $perPage = (int) ($this->request->getGet('per_page') ?: 12);
        $q       = trim((string) $this->request->getGet('q'));
        $kat     = trim((string) ($this->request->getGet('kategori') ?? ''));

        // Base query: ambil semua quiz aktif
        $model = $model->select('id_quiz, slug, judul, kategori, deskripsi, thumbnail, is_virtual_all, status, created_at')
            ->where('status', 'active');

        // Filter kategori (opsional)
        if ($kat !== '') {
            $model = $model->where('kategori', $kat);
        }

        // Pencarian (opsional)
        if ($q !== '') {
            $model = $model->groupStart()
                ->like('judul', $q)
                ->orLike('deskripsi', $q)
                ->orLike('kategori', $q)
                ->groupEnd();
        }

        // Urutan: tampilkan yang "Semua Kategori" (is_virtual_all=1) dulu, lalu terbaru
        $model = $model->orderBy('is_virtual_all', 'DESC')
            ->orderBy('id_quiz', 'DESC');

        // Paginate
        $quizzes = $model->paginate($perPage, 'quizzes');
        $pager   = $model->pager;

        return view('pages/public/quiz-list', [
            'title'    => 'TP PKK | Daftar Quiz',
            'navLink'  => 'Daftar Quiz',
            'quizzes'  => $quizzes,        // <-- loop di view
            'pager'    => $pager,          // <-- tampilkan pagination di view (opsional)
            'kategori' => $kat === '' ? 'Semua' : $kat,
            'q'        => $q,
        ]);
    }


    public function takeAll()
    {
        $allQuiz = $this->getAllQuiz();
        if (!$allQuiz) {
            return redirect()->back()->with('sweet_error', 'Quiz gabungan belum disiapkan.');
        }

        $questions = $this->QuizQuetions
            ->select('tb_quiz_questions.*, tb_quizzes.kategori, tb_quizzes.judul AS quiz_judul')
            ->join('tb_quizzes', 'tb_quizzes.id_quiz = tb_quiz_questions.quiz_id', 'left')
            ->where('tb_quizzes.status', 'active')
            ->orderBy('tb_quizzes.kategori', 'ASC')
            ->orderBy('tb_quiz_questions.urutan', 'ASC')
            ->findAll();

        if (empty($questions)) {
            return redirect()->to(site_url('/quiz-list'))->with('sweet_error', 'Belum ada soal.');
        }

        return view('pages/public/quiz-question', [
            'title'     => 'TP PKK | Quiz (Semua Kategori)',
            'navLink'   => 'Quiz',
            'quiz'      => $allQuiz,
            'questions' => $questions,
        ]);
    }
    public function submitQuizAll()
    {
        $quiz = $this->getAllQuiz();
        if (!$quiz) {
            return redirect()->to(site_url('kuis-masyarakat'))->with('sweet_error', 'Quiz gabungan belum disiapkan.');
        }

        $post = $this->request->getPost();

        // kumpulkan id pertanyaan dari name q_{id}
        $qidList = [];
        foreach ($post as $k => $v) {
            if (strpos($k, 'q_') === 0) {
                $id = (int) substr($k, 2);
                if ($id > 0) $qidList[] = $id;
            }
        }
        $qidList = array_values(array_unique($qidList));
        if (empty($qidList)) {
            return redirect()->back()->with('sweet_error', 'Tidak ada jawaban yang dikirim.');
        }

        $questions = $this->QuizQuetions
            ->select('tb_quiz_questions.*, tb_quizzes.kategori, tb_quizzes.judul AS quiz_judul')
            ->join('tb_quizzes', 'tb_quizzes.id_quiz = tb_quiz_questions.quiz_id', 'left')
            ->whereIn('tb_quiz_questions.id_pertanyaan', $qidList)
            ->findAll();

        // catat attempt pada quiz virtual
        $now   = date('Y-m-d H:i:s');
        $token = bin2hex(random_bytes(16));
        $attemptId = $this->QuizAttempts->insert([
            'quiz_id'      => (int)$quiz['id_quiz'],
            'token'        => $token,
            'mulai_sesi'   => $now,
            'selesai_sesi' => $now,
            'durasi_detik' => 0,
            'benar'        => 0,
            'salah'        => 0,
            'skor_total'   => 0,
            'ip_address'   => $this->request->getIPAddress(),
            'user_agent'   => $this->request->getUserAgent()->getAgentString(),
            'created_at'   => $now,
            'updated_at'   => $now,
        ], true);

        $benar = 0;
        $salah = 0;
        $skor = 0;
        $results = [];

        foreach ($questions as $q) {
            $qid   = (int)$q['id_pertanyaan'];
            $name  = 'q_' . $qid;
            $jawab = strtoupper((string)($post[$name] ?? ''));
            $kunci = (string)($q['kunci_jawaban'] ?? '');
            $ok    = ($jawab && $jawab === $kunci) ? 1 : 0;
            $nilai = $ok ? (int)($q['skor'] ?? 1) : 0;

            $this->QuizAnswers->insert([
                'attempt_id'    => $attemptId,
                'pertanyaan_id' => $qid,
                'jawaban'       => in_array($jawab, ['A', 'B', 'C', 'D']) ? $jawab : null,
                'is_benar'      => $ok,
                'skor'          => $nilai,
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            if ($ok) {
                $benar++;
                $skor += $nilai;
            } else {
                $salah++;
            }

            $results[] = [
                'pertanyaan'  => $q['pertanyaan'],
                'jawaban'     => $jawab,
                'benar'       => $kunci,
                'is_correct'  => $ok === 1,
                'opsi_a'      => $q['opsi_a'],
                'opsi_b'      => $q['opsi_b'],
                'opsi_c'      => $q['opsi_c'],
                'opsi_d'      => $q['opsi_d'],
                'kategori'    => $q['kategori'],
                'quiz_judul'  => $q['quiz_judul'],
            ];
        }

        $this->QuizAttempts->update($attemptId, [
            'benar'      => $benar,
            'salah'      => $salah,
            'skor_total' => $skor,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Tampilkan hasil langsung (atau redirect ke thanks/result kalau mau)
        return view('pages/public/result-quiz', [
            'title'   => 'Hasil Quiz (Semua Kategori)',
            'navLink' => 'Hasil Quiz',
            'quiz'    => $quiz,
            'score'   => $skor,
            'benar'   => $benar,
            'salah'   => $salah,
            'results' => $results,
            'token'   => $token,
        ]);
    }


    public function HubungiKami()
    {
        $data = [
            'title' => 'Hubungi Kami | PKK Kelurahan Lebak Denok',
            'navLink' => 'HubungiKami' //untuk navlink 
        ];
        return view('pages/public/hubungi', $data);
    }
    public function ProgramPkk()
    {
        $data = [
            'title' => 'Program Kami | PKK Kelurahan Lebak Denok',
            'navLink' => 'ProgramKami' //untuk navlink 
        ];
        return view('pages/public/program-pkk', $data);
    }
    public function FormPendaftaran()
    {
        $data = [
            'title' => 'Form Pendaftaran | PKK Kelurahan Lebak Denok',
            'navLink' => 'Pendaftaran' //untuk navlink 
        ];
        return view('pages/public/form-pendaftaran', $data);
    }
    public function Sekretariat()
    {
        $data = [
            'title' => 'Sekretariat | PKK Kelurahan Lebak Denok',
            'navLink' => 'Sekretariat' //untuk navlink 
        ];
        return view('pages/public/Sekretariat', $data);
    }
    public function DetailSekret()
    {
        $data = [
            'title' => 'Detail Sekretariat | PKK Kelurahan Lebak Denok',
            'navLink' => 'Detail Sekretariat' //untuk navlink 
        ];
        return view('pages/public/detail-sekret', $data);
    }
}
