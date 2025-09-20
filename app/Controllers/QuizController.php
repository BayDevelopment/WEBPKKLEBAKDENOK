<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPertanyaan;
use App\Models\ModelQuiz;
use App\Models\QuizModel;
use CodeIgniter\HTTP\ResponseInterface;

class QuizController extends BaseController
{
    protected $ModelQuiz;
    protected $ModelPertanyaan;
    public function __construct()
    {
        $this->ModelQuiz = new QuizModel();
        $this->ModelPertanyaan = new ModelPertanyaan();
    }
    public function page_tambah_quiz()
    {
        $data = [
            'title' => 'TP PKK | Tambah Quiz',
            'sub_judul' => 'Tambah',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/admin/tambah-quiz', $data);
    }
    public function AksiQuiz() // route: admin/quiz/store
    {
        $session = session();

        // FILE: thumbnail (opsional saat create)
        $thumb       = $this->request->getFile('thumbnail');
        $hasNewThumb = $thumb && $thumb->getError() !== UPLOAD_ERR_NO_FILE;

        // Jika user memilih file → validasi jenis/ukuran. Kalau tidak, biarkan kosong.
        $thumbRules = $hasNewThumb
            ? 'is_image[thumbnail]'
            . '|mime_in[thumbnail,image/jpg,image/jpeg,image/png]'
            . '|ext_in[thumbnail,jpg,jpeg,png]'
            . '|max_size[thumbnail,2048]' // 2MB
            : 'permit_empty';

        // NOTE: perbaiki koma ganda pada in_list kategori (hapus nilai kosong).
        // NOTE: Jika ingin mengizinkan 'draft', tambahkan ke in_list & opsi view.
        $rules = [
            'judul' => [
                'label'  => 'Judul',
                'rules'  => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'min_length' => '{field} minimal {param} karakter.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],
            'slug' => [
                'label'  => 'Slug',
                'rules'  => 'required|alpha_dash|min_length[3]|max_length[160]|is_unique[tb_quizzes.slug]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'alpha_dash' => '{field} hanya boleh huruf, angka, -, dan _.',
                    'is_unique'  => '{field} sudah dipakai, gunakan yang lain.',
                ],
            ],
            'kategori' => [
                'label'  => 'Kategori',
                'rules'  => 'required|in_list[PKK,Stunting,Pola Asuh,Digitalisasi,Semua]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid.',
                ],
            ],
            'deskripsi' => [
                'label'  => 'Deskripsi',
                'rules'  => 'permit_empty|max_length[2000]',
                'errors' => [
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],
            'durasi_menit' => [
                'label'  => 'Durasi (menit)',
                'rules'  => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[600]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'integer'  => '{field} harus bilangan bulat.',
                    'greater_than_equal_to' => '{field} minimal {param}.',
                    'less_than_equal_to'    => '{field} maksimal {param}.',
                ],
            ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required|in_list[active,inactive]', // tambahkan 'draft' jika perlu
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid.',
                ],
            ],
            'is_virtual_all' => [
                'label'  => 'Buka untuk Semua',
                'rules'  => 'permit_empty|in_list[1]', // checkbox → "1" jika dicentang
            ],
            'thumbnail' => [
                'label'  => 'Thumbnail',
                'rules'  => $thumbRules,
                'errors' => [
                    'is_image' => 'File bukan gambar yang valid.',
                    'mime_in'  => 'Format tidak didukung. Gunakan JPG/PNG.',
                    'ext_in'   => 'Ekstensi file tidak didukung. Gunakan JPG/PNG.',
                    'max_size' => 'Ukuran file terlalu besar. Maks 2048 KB (≈ 2 MB).',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_errors', array_values($this->validator->getErrors()));
        }

        // HANDLE FILE (jika ada)
        $thumbName = null;
        if ($hasNewThumb && $thumb->isValid() && $thumb->getError() === UPLOAD_ERR_OK) {
            $targetPath = FCPATH . 'assets/uploads/quiz';
            if (! is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }
            $ext      = strtolower($thumb->getExtension() ?: 'jpg');
            $safeName = 'quiz_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;

            if (! $thumb->move($targetPath, $safeName)) {
                return redirect()->back()->withInput()
                    ->with('sweet_errors', ['Upload gagal: ' . ($thumb->getErrorString() ?? 'Gagal memindahkan file.')]);
            }
            $thumbName = $safeName;
        }

        // NORMALISASI INPUT
        $data = [
            'judul'          => (string) $this->request->getPost('judul'),
            'slug'           => (string) $this->request->getPost('slug'),
            'kategori'       => (string) $this->request->getPost('kategori'),
            'deskripsi'      => (string) $this->request->getPost('deskripsi'),
            'durasi_menit'   => (int)    $this->request->getPost('durasi_menit'),
            'status'         => (string) $this->request->getPost('status'),  // active|inactive (atau draft jika ditambah)
            'is_virtual_all' => $this->request->getPost('is_virtual_all') ? 1 : 0,
            'thumbnail'      => $thumbName,
        ];

        $model = new \App\Models\QuizModel();
        try {
            $model->insert($data);
            return redirect()->to(site_url('admin/quiz'))
                ->with('sweet_success', 'Quiz berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()
                ->with('sweet_errors', ['Terjadi kesalahan, silakan coba lagi.']);
        }
    }

    public function page_edit(int $id)
    {
        $quiz = (new QuizModel())->find($id);
        if (!$quiz) {
            // throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Quiz #$id tidak ditemukan");
            return redirect()->to(site_url('admin/quiz'))
                ->with('sweet_error', 'Data tidak ditemukan.');
        }

        return view('pages/admin/edit-quiz', [
            'title'       => 'TP PKK | Edit Quiz',
            'sub_judul'   => 'Edit',
            'quiz'        => $quiz,
            'validation'  => \Config\Services::validation(),
        ]);
    }
    public function EditQuiz(int $id)
    {

        $quizModel = new \App\Models\QuizModel();
        $existing  = $quizModel->find($id);

        if (!$existing) {
            return redirect()->to(site_url('admin/quiz'))
                ->with('sweet_error', 'Data tidak ditemukan.');
        }

        // FILE thumbnail (opsional)
        $thumb       = $this->request->getFile('thumbnail');
        $hasNewThumb = $thumb && $thumb->getError() !== UPLOAD_ERR_NO_FILE;

        // Jika user memilih file → validasi jenis/ukuran. Kalau tidak, biarkan kosong.
        $thumbRules = $hasNewThumb
            ? 'is_image[thumbnail]'
            . '|mime_in[thumbnail,image/jpg,image/jpeg,image/png]'
            . '|ext_in[thumbnail,jpg,jpeg,png]'
            . '|max_size[thumbnail,2048]'   // 2 MB
            : 'permit_empty';

        // VALIDATION (slug unik, abaikan record ini)
        $rules = [
            'judul' => [
                'label'  => 'Judul',
                'rules'  => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'min_length' => '{field} minimal {param} karakter.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],
            'slug' => [
                'label'  => 'Slug',
                'rules'  => "required|alpha_dash|min_length[3]|max_length[160]|is_unique[tb_quizzes.slug,id_quiz,{$id}]",
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'alpha_dash' => '{field} hanya boleh huruf, angka, -, dan _.',
                    'is_unique'  => '{field} sudah dipakai, gunakan yang lain.',
                ],
            ],
            'kategori' => [
                'label'  => 'Kategori',
                'rules'  => 'required|in_list[PKK,Stunting,Pola Asuh,Digitalisasi,Semua]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid.',
                ],
            ],
            'deskripsi' => [
                'label'  => 'Deskripsi',
                'rules'  => 'permit_empty|max_length[2000]',
                'errors' => [
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],
            'durasi_menit' => [
                'label'  => 'Durasi (menit)',
                'rules'  => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[600]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'integer'  => '{field} harus bilangan bulat.',
                    'greater_than_equal_to' => '{field} minimal {param}.',
                    'less_than_equal_to'    => '{field} maksimal {param}.',
                ],
            ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required|in_list[active,inactive,draft]', // hapus 'draft' jika tidak dipakai
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid.',
                ],
            ],
            'is_virtual_all' => [
                'label'  => 'Buka untuk Semua',
                'rules'  => 'permit_empty|in_list[1]', // checkbox → "1" jika dicentang
            ],
            'thumbnail' => [
                'label'  => 'Thumbnail',
                'rules'  => $thumbRules,
                'errors' => [
                    'is_image' => 'File bukan gambar yang valid.',
                    'mime_in'  => 'Format tidak didukung. Gunakan JPG/PNG.',
                    'ext_in'   => 'Ekstensi file tidak didukung. Gunakan JPG/PNG.',
                    'max_size' => 'Ukuran file terlalu besar. Maks 2048 KB (≈ 2 MB).',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_errors', array_values($this->validator->getErrors())); // untuk SweetAlert list
        }

        // HANDLE UPLOAD (ganti & hapus lama jika ada file baru)
        $thumbName = $existing['thumbnail'] ?? null;

        if ($hasNewThumb && $thumb->isValid() && $thumb->getError() === UPLOAD_ERR_OK) {
            $targetPath = FCPATH . 'assets/uploads/quiz';
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }

            $ext      = strtolower($thumb->getExtension() ?: 'jpg');
            $newName  = 'quiz_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;

            if (!$thumb->move($targetPath, $newName)) {
                return redirect()->back()->withInput()
                    ->with('sweet_errors', ['Upload gagal: ' . ($thumb->getErrorString() ?? 'Gagal memindahkan file.')]);
            }

            // hapus lama (kalau ada)
            if (!empty($thumbName)) {
                $oldPath = $targetPath . DIRECTORY_SEPARATOR . $thumbName;
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $thumbName = $newName;
        }

        // NORMALISASI INPUT
        $payload = [
            'id_quiz'        => $id, // penting bila pakai save()
            'judul'          => (string) $this->request->getPost('judul'),
            'slug'           => (string) $this->request->getPost('slug'),
            'kategori'       => (string) $this->request->getPost('kategori'),
            'deskripsi'      => (string) $this->request->getPost('deskripsi'),
            'durasi_menit'   => (int)    $this->request->getPost('durasi_menit'),
            'status'         => (string) $this->request->getPost('status'), // active|inactive|draft
            'is_virtual_all' => $this->request->getPost('is_virtual_all') ? 1 : 0,
            'thumbnail'      => $thumbName,
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        try {
            // Bisa pakai update($id, $payload) atau save($payload) (karena ada primaryKey)
            $quizModel->save($payload);
            return redirect()->to(site_url('admin/quiz'))
                ->with('sweet_success', 'Quiz berhasil diperbarui.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()
                ->with('sweet_errors', ['Terjadi kesalahan, silakan coba lagi.']);
        }
    }

    public function detail_quiz(int $id)
    {
        $quizModel       = new QuizModel();
        $pertanyaanModel = new ModelPertanyaan();

        // --- Detail quiz yang dilihat ---
        $row = $quizModel->select('id_quiz, judul, slug, kategori, deskripsi, durasi_menit, status, is_virtual_all, thumbnail, created_at, updated_at')
            ->find($id);
        if (!$row) {
            return redirect()->to(site_url('admin/quiz'))
                ->with('sweet_error', 'Quiz tidak ditemukan.');
        }

        // --- PERTANYAAN untuk quiz ini (by id) ---
        $pertanyaan = $pertanyaanModel
            ->select('id_pertanyaan, quiz_id, urutan, pertanyaan, gambar, opsi_a, opsi_b, opsi_c, opsi_d, kunci_jawaban, skor, created_at')
            ->where('quiz_id', $id)
            ->orderBy('urutan', 'ASC')
            ->findAll();

        $totalSoal = (new ModelPertanyaan())
            ->where('quiz_id', $id)
            ->countAllResults();

        // --- Quiz lain dalam kategori yang sama (opsional/list samping) ---
        $quizzesSeKategori = (new QuizModel())
            ->select('id_quiz, judul, kategori, durasi_menit, status, thumbnail, created_at')
            ->where('kategori', $row['kategori'])
            ->where('id_quiz !=', $id)
            ->orderBy('created_at', 'DESC')
            ->findAll(20);

        // --- SEMUA QUIZ (untuk ditampilkan di bawah) ---
        $quizzesAll = (new QuizModel())
            ->select('id_quiz, judul, kategori, deskripsi, durasi_menit, status, thumbnail, created_at')
            ->orderBy('created_at', 'DESC')
            ->findAll(); // kalau perlu pagination, nanti diganti paginate()

        // ======================================================
        // CHART: jumlah soal per kategori
        // ======================================================
        $allCategories = $quizModel->select('kategori')
            ->groupBy('kategori')
            ->orderBy('kategori', 'ASC')
            ->findColumn('kategori');
        if (!$allCategories) {
            $allCategories = [$row['kategori']];
        }

        $rowsCount = $pertanyaanModel
            ->select('tb_quizzes.kategori, COUNT(tb_quiz_questions.id_pertanyaan) AS total_soal')
            ->join('tb_quizzes', 'tb_quizzes.id_quiz = tb_quiz_questions.quiz_id', 'inner')
            ->where('tb_quizzes.status', 'active')
            ->groupBy('tb_quizzes.kategori')
            ->orderBy('tb_quizzes.kategori', 'ASC')
            ->findAll();

        $map = array_fill_keys($allCategories, 0);
        foreach ($rowsCount as $r) {
            $cat = $r['kategori'] ?? '';
            if ($cat !== '') {
                $map[$cat] = (int) $r['total_soal'];
            }
        }

        $chartLabels = array_keys($map);
        $chartData   = array_values($map);

        $totalQuizDalamKategori = (new QuizModel())
            ->where('kategori', $row['kategori'])
            ->countAllResults();

        $row['total_quiz'] = $totalQuizDalamKategori;
        $row['total_soal'] = $totalSoal;

        return view('pages/admin/detail-quiz', [
            'title'         => 'TP PKK | Detail Quiz',
            'sub_judul'     => 'Detail',
            'row'           => $row,
            'pertanyaan'    => $pertanyaan,
            'quizzes'       => $quizzesSeKategori, // tetap: “quiz se-kategori”
            'quizzes_all'   => $quizzesAll,        // baru: “semua quiz” untuk ditaruh di bawah
            'chart_labels'  => $chartLabels,
            'chart_data'    => $chartData,
        ]);
    }
    public function delete_quizById($id_quiz)
    {
        $quizModel = new \App\Models\QuizModel();

        $quiz = $quizModel->find($id_quiz);
        if (!$quiz) {
            return redirect()->to(site_url('admin/quiz'))
                ->with('sweet_error', 'Quiz tidak ditemukan.');
        }

        // jika ada file thumbnail, hapus
        if (!empty($quiz['thumbnail'])) {
            $path = FCPATH . 'assets/uploads/quiz/' . $quiz['thumbnail'];
            if (is_file($path)) {
                @unlink($path);
            }
        }

        $quizModel->delete($id_quiz);

        return redirect()->to(site_url('admin/quiz'))
            ->with('sweet_success', 'Quiz berhasil dihapus.');
    }




    // page insert quis soal berdasarkan slug ( kategori )
    public function page_soalByKategori(string $slug)
    {
        // ambil 1 quiz by slug
        $quiz = $this->ModelQuiz->where('slug', $slug)->first();

        if (!$quiz) {
            // 404 atau redirect dengan flash message
            // throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Quiz dengan slug '{$slug}' tidak ditemukan.");
            return redirect()->to(site_url('admin/quiz'))
                ->with('sweet_error', 'Data Quiz tidak ditemukan.');
        }

        // opsional: ambil daftar soal milik quiz tsb
        $soal = $this->ModelPertanyaan
            ->where('quiz_id', $quiz['id_quiz'])
            ->orderBy('urutan', 'ASC')
            ->findAll();

        $data = [
            'title' => 'TP PKK | Tambah Soal ' . ($quiz['judul'] ?? ucfirst($slug)),
            'sub_judul' => 'Tambah Soal' . ($quiz['judul'] ?? ucfirst($slug)),
            'quiz'  => $quiz,
            'soal'  => $soal, // opsional, hapus jika belum perlu
            'validation'  => \Config\Services::validation()
        ];

        return view('pages/admin/tambah-soal-quiz', $data);
    }


    public function AksiSoalByKategori(string $slug)
    {
        $session = session();

        // --- Ambil quiz by slug ---
        $quiz = (new \App\Models\QuizModel())
            ->select('id_quiz, slug, judul, kategori')
            ->where('slug', $slug)
            ->first();

        if (!$quiz) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_errors', ['Maaf, data tidak sesuai.']);
        }

        // --- File gambar (opsional) ---
        $img      = $this->request->getFile('gambar');
        $imgRules = 'permit_empty'
            . '|is_image[gambar]'
            . '|mime_in[gambar,image/jpg,image/jpeg,image/png]'
            . '|ext_in[gambar,jpg,jpeg,png]'
            . '|max_size[gambar,2048]';

        // --- VALIDASI (sekali jalan, termasuk file) ---
        $rules = [
            'quiz_id' => [
                'label'  => 'Quiz',
                'rules'  => 'required|is_natural_no_zero|in_list[' . (int)$quiz['id_quiz'] . ']',
                'errors' => [
                    'required'           => '{field} tidak diketahui.',
                    'is_natural_no_zero' => '{field} tidak valid.',
                    'in_list'            => 'Maaf, data {field} tidak sama.',
                ],
            ],
            'urutan' => [
                'label'  => 'Urutan',
                'rules'  => 'required|is_natural_no_zero',
                'errors' => [
                    'required'           => '{field} wajib diisi.',
                    'is_natural_no_zero' => '{field} harus bilangan bulat ≥ 1.',
                ],
            ],
            'skor' => [
                'label'  => 'Skor',
                'rules'  => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
                'errors' => [
                    'required'               => '{field} wajib diisi.',
                    'integer'                => '{field} harus bilangan bulat.',
                    'greater_than_equal_to'  => '{field} harus ≥ {param}.',
                    'less_than_equal_to'     => '{field} harus ≤ {param}.',
                ],
            ],
            'pertanyaan' => [
                'label'  => 'Pertanyaan',
                'rules'  => 'required|min_length[5]|max_length[2000]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'min_length' => '{field} minimal {param} karakter.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],
            'opsi_a' => [
                'label'  => 'Opsi A',
                'rules'  => 'required|max_length[500]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],
            'opsi_b' => [
                'label'  => 'Opsi B',
                'rules'  => 'required|max_length[500]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],
            'opsi_c' => [
                'label'  => 'Opsi C',
                'rules'  => 'required|max_length[500]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],
            'opsi_d' => [
                'label'  => 'Opsi D',
                'rules'  => 'required|max_length[500]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],
            'kunci_jawaban' => [
                'label'  => 'Kunci Jawaban',
                'rules'  => 'required|in_list[A,B,C,D]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} harus salah satu dari: {param}.',
                ],
            ],
            'gambar' => [
                'label'  => 'Gambar',
                'rules'  => $imgRules,
                'errors' => [
                    'is_image' => '{field} harus berupa gambar yang valid.',
                    'mime_in'  => 'Tipe file {field} harus salah satu dari: {param}.',
                    'ext_in'   => 'Ekstensi {field} harus salah satu dari: {param}.',
                    'max_size' => 'Ukuran {field} maksimal {param} KB.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_errors', array_values($this->validator->getErrors())); // Swal list error
        }

        // --- Ambil nilai valid ---
        $quizId = (int)$quiz['id_quiz'];
        $urutan = (int)$this->request->getPost('urutan');

        // --- Cek unik (quiz_id, urutan) ---
        $soalModel = new \App\Models\ModelPertanyaan();
        if ($soalModel->where(['quiz_id' => $quizId, 'urutan' => $urutan])->first()) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_errors', ['Urutan sudah dipakai di quiz ini.']);
        }

        // --- Upload gambar opsional ---
        $gambarName = null;
        if ($img && $img->isValid() && $img->getError() === UPLOAD_ERR_OK) {
            $dir = FCPATH . 'assets/uploads/soal';
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            $safe = 'soal_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . strtolower($img->getExtension() ?: 'jpg');
            if (! $img->move($dir, $safe)) {
                return redirect()->back()->withInput()
                    ->with('sweet_errors', ['Upload gambar gagal: ' . ($img->getErrorString() ?? 'Gagal memindahkan file.')]);
            }
            $gambarName = $safe;
        }

        // --- Simpan ---
        $payload = [
            'quiz_id'       => $quizId, // pakai yang pasti dari slug
            'urutan'        => $urutan,
            'pertanyaan'    => (string)$this->request->getPost('pertanyaan'),
            'opsi_a'        => (string)$this->request->getPost('opsi_a'),
            'opsi_b'        => (string)$this->request->getPost('opsi_b'),
            'opsi_c'        => (string)$this->request->getPost('opsi_c'),
            'opsi_d'        => (string)$this->request->getPost('opsi_d'),
            'kunci_jawaban' => (string)$this->request->getPost('kunci_jawaban'),
            'skor'          => (int)$this->request->getPost('skor'),
            'gambar'        => $gambarName, // null kalau tidak ada
        ];

        try {
            $soalModel->insert($payload);
            return redirect()->to(site_url('admin/quiz/'))
                ->with('sweet_success', 'Soal berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()
                ->with('sweet_errors', ['Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']);
        }
    }


    // app/Controllers/QuizSoalController.php

    // Halaman edit soal berdasar (id_quiz, urutan)
    public function page_editByIdUrutan(int $id_quiz, int $urutan)
    {
        $quizModel = new QuizModel();
        $soalModel = new ModelPertanyaan();

        // Pastikan quiz ada
        $quiz = $quizModel->find($id_quiz);
        if (!$quiz) {
            return redirect()->to(site_url('admin/quiz'))
                ->with('sweet_error', 'Quiz tidak ditemukan.');
        }

        // Ambil soal berdasar pasangan kunci (id_quiz, urutan)
        $soal = $soalModel->where('quiz_id', $id_quiz)
            ->where('urutan',  $urutan)
            ->first();
        if (!$soal) {
            return redirect()->to(site_url('admin/quiz/detail/' . $id_quiz))
                ->with('sweet_error', 'Soal tidak ditemukan.');
        }

        return view('pages/admin/edit-soal-quiz', [
            'title'      => 'TP PKK | Edit Soal',
            'sub_judul'  => 'Edit Soal ' . (int) $urutan, // atau 'Edit Soal #' . (int)$urutan
            'quiz'       => $quiz,
            'soal'       => $soal,
            'validation' => \Config\Services::validation(),
        ]);
    }

    // Update soal berdasar (id_quiz, urutanSemula)
    public function updateByIdUrutan(int $id_quiz, int $urutanSemula)
    {
        $quizModel = new QuizModel();
        $soalModel = new ModelPertanyaan();

        // 1) Cek quiz
        $quiz = $quizModel->find($id_quiz);
        if (!$quiz) {
            return redirect()->to(site_url('admin/quiz'))
                ->with('sweet_error', 'Quiz tidak ditemukan.');
        }

        // 2) Cek soal asal
        $soal = $soalModel->where('quiz_id', $id_quiz)
            ->where('urutan', $urutanSemula)
            ->first();
        if (!$soal) {
            return redirect()->to(site_url('admin/quiz/detail/' . $id_quiz))
                ->with('sweet_error', 'Soal tidak ditemukan.');
        }

        // 3) File gambar opsional -> aturan dinamis
        $gambar      = $this->request->getFile('gambar');
        $gambarRules = 'permit_empty';
        if ($gambar && $gambar->getError() !== UPLOAD_ERR_NO_FILE) {
            $gambarRules = 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|ext_in[gambar,jpg,jpeg,png]|max_size[gambar,2048]';
        }

        // 4) Rules field lain
        $rules = [
            'urutan' => [
                'label'  => 'Urutan',
                'rules'  => 'required|is_natural_no_zero',
                'errors' => [
                    'required'           => '{field} wajib diisi.',
                    'is_natural_no_zero' => '{field} harus bilangan bulat ≥ 1.',
                ],
            ],

            'pertanyaan' => [
                'label'  => 'Pertanyaan',
                'rules'  => 'required|min_length[5]|max_length[2000]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'min_length' => '{field} minimal {param} karakter.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],

            'opsi_a' => [
                'label'  => 'Opsi A',
                'rules'  => 'required|max_length[500]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],

            'opsi_b' => [
                'label'  => 'Opsi B',
                'rules'  => 'required|max_length[500]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],

            'opsi_c' => [
                'label'  => 'Opsi C',
                'rules'  => 'required|max_length[500]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],

            'opsi_d' => [
                'label'  => 'Opsi D',
                'rules'  => 'required|max_length[500]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ],
            ],

            'kunci_jawaban' => [
                'label'  => 'Kunci Jawaban',
                'rules'  => 'required|in_list[A,B,C,D]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} harus salah satu dari: {param}.',
                ],
            ],

            'skor' => [
                'label'  => 'Skor',
                'rules'  => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
                'errors' => [
                    'required'                => '{field} wajib diisi.',
                    'integer'                 => '{field} harus berupa bilangan bulat.',
                    'greater_than_equal_to'   => '{field} harus ≥ {param}.',
                    'less_than_equal_to'      => '{field} harus ≤ {param}.',
                ],
            ],

            // $gambarRules sudah kamu set dinamis (permit_empty atau aturan file).
            // Di sini siapkan pesan untuk setiap kemungkinan rule file.
            'gambar' => [
                'label'  => 'Gambar',
                'rules'  => $gambarRules,
                'errors' => [
                    'uploaded'  => '{field} wajib diunggah.',
                    'is_image'  => '{field} harus berupa gambar yang valid.',
                    'mime_in'   => 'Tipe file {field} harus salah satu dari: {param}.',
                    'ext_in'    => 'Ekstensi {field} harus salah satu dari: {param}.',
                    'max_size'  => 'Ukuran {field} maksimal {param} KB.',
                ],
            ],
        ];


        // 5) VALIDASI
        if (! $this->validate($rules)) {
            // >>> INI YANG PENTING: kirim array errors ke session
            $errors = $this->validator->getErrors();

            return redirect()->back()
                ->withInput()
                ->with('errors', $errors)                 // <-- dipakai di view
                ->with('sweet_error', 'Periksa kembali isian formulir.'); // konsisten 1 key
        }

        // 6) Cek bentrok urutan bila diubah
        $urutanBaru = (int) $this->request->getPost('urutan');
        if ($urutanBaru !== (int) $urutanSemula) {
            $bentrok = $soalModel->where('quiz_id', $id_quiz)
                ->where('urutan', $urutanBaru)
                ->first();
            if ($bentrok) {
                return redirect()->back()->withInput()
                    ->with('errors', ['urutan' => 'Urutan sudah dipakai soal lain pada quiz ini.'])
                    ->with('sweet_error', 'Urutan sudah dipakai soal lain pada quiz ini.');
            }
        }

        // 7) Handle upload (jika ada)
        $gambarName = $soal['gambar'] ?? null;
        if ($gambar && $gambar->isValid() && $gambar->getError() === UPLOAD_ERR_OK) {
            $targetPath = FCPATH . 'assets/uploads/quiz';
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }

            $ext = strtolower($gambar->getExtension() ?: 'jpg');
            $newName = 'soal_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;

            if ($gambar->move($targetPath, $newName)) {
                if (!empty($gambarName)) {
                    $old = $targetPath . DIRECTORY_SEPARATOR . $gambarName;
                    if (is_file($old)) {
                        @unlink($old);
                    }
                }
                $gambarName = $newName;
            } else {
                return redirect()->back()->withInput()
                    ->with('errors', ['gambar' => 'Upload gambar gagal: ' . ($gambar->getErrorString() ?? 'Gagal memindahkan file.')])
                    ->with('sweet_error', 'Upload gambar gagal.');
            }
        }

        // 8) Payload update
        $payload = [
            'urutan'        => $urutanBaru,
            'pertanyaan'    => (string) $this->request->getPost('pertanyaan'),
            'opsi_a'        => (string) $this->request->getPost('opsi_a'),
            'opsi_b'        => (string) $this->request->getPost('opsi_b'),
            'opsi_c'        => (string) $this->request->getPost('opsi_c'),
            'opsi_d'        => (string) $this->request->getPost('opsi_d'),
            'kunci_jawaban' => (string) $this->request->getPost('kunci_jawaban'),
            'skor'          => (int)    $this->request->getPost('skor'),
            'gambar'        => $gambarName,
        ];

        // 9) Simpan
        try {
            $soalModel->where('quiz_id', $id_quiz)
                ->where('urutan', $urutanSemula)
                ->set($payload)
                ->update();

            return redirect()->to(site_url('admin/quiz/detail/' . $id_quiz))
                ->with('sweet_success', 'Soal berhasil diperbarui.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()
                ->with('sweet_error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function deleteByIdUrutan(int $id_quiz, int $urutan)
    {
        $quizModel = new QuizModel();          // Punya kolom `status`
        $soalModel = new ModelPertanyaan();    // SoftDeletes aktif

        // 1. Cek quiz
        $quiz = $quizModel->find($id_quiz);
        if (!$quiz) {
            return redirect()->to(site_url('admin/quiz'))
                ->with('sweet_error', 'Quiz tidak ditemukan.');
        }

        // 2. Cek soal
        $soal = $soalModel->where('quiz_id', $id_quiz)
            ->where('urutan', $urutan)
            ->first();
        if (!$soal) {
            return redirect()->to(site_url('admin/quiz/detail/' . $id_quiz))
                ->with('sweet_error', 'Soal tidak ditemukan.');
        }

        // 3. (Opsional) hapus file gambar fisik
        if (!empty($soal['gambar'])) {
            $path = FCPATH . 'assets/uploads/quiz/' . $soal['gambar'];
            if (is_file($path)) {
                @unlink($path);
            }
        }

        // 4. Soft delete soal + set status quiz = inactive
        try {
            // Soft delete soal (isi deleted_at di tabel pertanyaan)
            $soalModel->where('quiz_id', $id_quiz)
                ->where('urutan', $urutan)
                ->delete();

            // Update status quiz jadi inactive
            $quizModel->update($id_quiz, ['status' => 'inactive']);

            return redirect()->to(site_url('admin/quiz/detail/' . $id_quiz))
                ->with('sweet_success', 'Soal dihapus dan status quiz dinonaktifkan.');
        } catch (\Throwable $e) {
            return redirect()->back()
                ->with('sweet_error', 'Terjadi kesalahan saat menghapus soal.');
        }
    }
}
