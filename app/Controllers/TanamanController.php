<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TanamankuModel;
use CodeIgniter\HTTP\ResponseInterface;

class TanamanController extends BaseController
{
    protected $ModelTanamanku;
    public function __construct()
    {
        $this->ModelTanamanku = new TanamankuModel();
    }
    public function page_tambah_tanamanku()
    {
        $data = [
            'title' => 'TP PKK | Tambah Tanaman',
            'sub_judul' => 'Tambah',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/admin/tambah-data-tanaman', $data);
    }
    public function AksiTanamanku()
    {
        $session = session();

        // 1) SATU KALI VALIDATE (termasuk file)
        $rules = [
            'nama_umum' => [
                'label'  => 'Nama Umum',
                'rules'  => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'min_length' => '{field} minimal {param} karakter.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ]
            ],
            'nama_latin'        => ['label' => 'Nama Latin',   'rules' => 'permit_empty|max_length[150]'],
            'asal_daerah'       => ['label' => 'Asal Daerah',  'rules' => 'permit_empty|max_length[150]'],
            'manfaat'           => ['label' => 'Manfaat',      'rules' => 'permit_empty|max_length[2000]'],
            'keterangan'        => ['label' => 'Keterangan',   'rules' => 'permit_empty|max_length[3000]'],
            'tanggal_pendataan' => [
                'label'  => 'Tanggal Pendataan',
                'rules'  => 'required|valid_date[Y-m-d\TH:i]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'valid_date' => '{field} tidak valid. Gunakan format YYYY-MM-DDTHH:MM.',
                ]
            ],
            'jumlah' => [
                'label'  => 'Jumlah',
                'rules'  => 'required|is_natural_no_zero',
                'errors' => [
                    'required'           => '{field} wajib diisi.',
                    'is_natural_no_zero' => '{field} harus bilangan bulat dan minimal 1.',
                ]
            ],
            'lokasi_gps_lat'    => ['label' => 'Latitude',     'rules' => 'permit_empty|decimal'],
            'lokasi_gps_lng'    => ['label' => 'Longitude',    'rules' => 'permit_empty|decimal'],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required|in_list[active,inactive]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid. Pilih active atau inactive.',
                ]
            ],

            // >>> FILE DI-VALIDASI DI SINI (TANPA return awal)
            'foto_tanaman' => [
                'label'  => 'Foto Tanaman',
                'rules'  => 'uploaded[foto_tanaman]'
                    . '|max_size[foto_tanaman,2048]'
                    . '|is_image[foto_tanaman]'
                    . '|mime_in[foto_tanaman,image/jpg,image/jpeg,image/png]'
                    . '|ext_in[foto_tanaman,jpg,jpeg,png]',
                'errors' => [
                    'uploaded' => '{field} wajib diunggah.',
                    'max_size' => 'Ukuran file melebihi 2 MB.',
                    'is_image' => 'File bukan gambar yang valid atau rusak.',
                    'mime_in'  => 'Format tidak didukung. Gunakan JPG/PNG.',
                    'ext_in'   => 'Ekstensi file tidak didukung. Gunakan JPG/PNG.',
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            // kirim SEMUA pesan error (buat SweetAlert) + old input
            return redirect()->back()
                ->withInput()
                ->with('sweet_errors', array_values($this->validator->getErrors()));
        }

        // 2) VALIDASI LOLOS → pindahkan file
        $file = $this->request->getFile('foto_tanaman');
        $targetPath = FCPATH . 'assets/uploads/tanaman';
        if (! is_dir($targetPath)) {
            mkdir($targetPath, 0755, true);
        }
        $ext      = strtolower($file->getExtension() ?: 'jpg');
        $safeName = 'tanaman_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;

        if (! $file->move($targetPath, $safeName)) {
            return redirect()->back()->withInput()
                ->with('sweet_errors', ['Upload gagal: ' . ($file->getErrorString() ?? 'Gagal memindahkan file.')]);
        }

        // 3) Normalisasi tanggal
        $tglInput    = (string) $this->request->getPost('tanggal_pendataan');
        $dt          = \DateTime::createFromFormat('Y-m-d\TH:i', $tglInput, new \DateTimeZone('Asia/Jakarta'));
        $tanggalSql  = $dt ? $dt->format('Y-m-d H:i:00') : null;

        // 4) Susun data & simpan
        $data = [
            'nama_umum'         => (string) $this->request->getPost('nama_umum'),
            'nama_latin'        => (string) $this->request->getPost('nama_latin'),
            'asal_daerah'       => (string) $this->request->getPost('asal_daerah'),
            'manfaat'           => (string) $this->request->getPost('manfaat'),
            'keterangan'        => (string) $this->request->getPost('keterangan'),
            'tanggal_pendataan' => $tanggalSql,
            'jumlah'            => (int) ($this->request->getPost('jumlah') ?? 0),
            'petugas_id'        => (int) ($session->get('id_admin') ?? 0),
            'petugas_nama'      => (string) ($session->get('username') ?? ''),
            'lokasi_gps_lat'    => $this->request->getPost('lokasi_gps_lat') !== '' ? (float) $this->request->getPost('lokasi_gps_lat') : null,
            'lokasi_gps_lng'    => $this->request->getPost('lokasi_gps_lng') !== '' ? (float) $this->request->getPost('lokasi_gps_lng') : null,
            'status'            => strtolower((string) $this->request->getPost('status')),
            'foto_tanaman'      => $safeName,
        ];

        $model = new \App\Models\TanamankuModel();
        try {
            $model->insert($data);
            return redirect()->to(route_to('admin/tanamanku'))
                ->with('sweet_success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $e) {
            @unlink($targetPath . DIRECTORY_SEPARATOR . $safeName);
            return redirect()->back()->withInput()
                ->with('sweet_errors', ['Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']);
        }
    }

    public function page_edit_tanamanku($id)
    {
        // (opsional) pastikan hanya admin
        // if (session('role') !== 'admin') return redirect()->to('login')->with('sweet_error','Akses ditolak.');

        $id  = (int) $id;
        $row = $this->ModelTanamanku->find($id); // ← ambil by primary key (mis. id_tanamanku)

        if (! $row) {
            // Bisa juga: throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data tidak ditemukan.');
            return redirect()->to(site_url('admin/tanamanku'))
                ->with('sweet_error', 'Data tidak ditemukan.');
        }

        $data = [
            'title'     => 'TP PKK | Edit Tanaman',
            'sub_judul' => 'Edit Tanaman',
            'row'       => $row, // ← konsisten dengan view edit yang pakai $row
            // Validator untuk initial load; saat gagal validasi gunakan session('validation')
            'validation' => \Config\Services::validation(),
        ];

        return view('pages/admin/edit-tanamanku', $data);
    }

    public function EditTanamanku($id)
    {
        $session = session();
        $model   = new \App\Models\TanamankuModel();

        // 0) Ambil data lama
        $row = $model->find($id);
        if (!$row) {
            return redirect()->to(route_to('admin/tanamanku'))
                ->with('sweet_error', 'Data Tanamanku tidak ditemukan atau sudah dihapus.');
        }

        // 1) Rules — file opsional saat edit
        $file       = $this->request->getFile('foto_tanaman');
        $hasNewFile = $file && $file->isValid() && $file->getError() !== UPLOAD_ERR_NO_FILE;

        $fotoRules = $hasNewFile
            ? 'is_image[foto_tanaman]'
            . '|mime_in[foto_tanaman,image/jpg,image/jpeg,image/png]'
            . '|ext_in[foto_tanaman,jpg,jpeg,png]'
            . '|max_size[foto_tanaman,3072]'   // 3MB
            : 'permit_empty';

        $rules = [
            'nama_umum' => [
                'label'  => 'Nama Umum',
                'rules'  => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'min_length' => '{field} minimal {param} karakter.',
                    'max_length' => '{field} maksimal {param} karakter.',
                ]
            ],
            'nama_latin'        => ['label' => 'Nama Latin', 'rules' => 'permit_empty|max_length[150]'],
            'asal_daerah'       => ['label' => 'Asal Daerah', 'rules' => 'permit_empty|max_length[150]'],
            'manfaat'           => ['label' => 'Manfaat', 'rules' => 'permit_empty|max_length[2000]'],
            'keterangan'        => ['label' => 'Keterangan', 'rules' => 'permit_empty|max_length[3000]'],
            'tanggal_pendataan' => [
                'label'  => 'Tanggal Pendataan',
                'rules'  => 'required|valid_date[Y-m-d\TH:i]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'valid_date' => '{field} tidak valid. Gunakan format YYYY-MM-DDTHH:MM.',
                ]
            ],
            'jumlah' => [
                'label'  => 'Jumlah',
                'rules'  => 'required|is_natural_no_zero',
                'errors' => [
                    'required'           => '{field} wajib diisi.',
                    'is_natural_no_zero' => '{field} harus bilangan bulat dan minimal 1.',
                ]
            ],
            'lokasi_gps_lat'    => ['label' => 'Latitude', 'rules' => 'permit_empty|decimal'],
            'lokasi_gps_lng'    => ['label' => 'Longitude', 'rules' => 'permit_empty|decimal'],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required|in_list[active,inactive]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid. Pilih salah satu: active atau inactive.',
                ]
            ],
            'foto_tanaman' => [
                'label'  => 'Foto Tanaman',
                'rules'  => $fotoRules,
                'errors' => [
                    'is_image' => 'File yang diunggah bukan gambar yang valid.',
                    'mime_in'  => 'Format gambar tidak didukung. Gunakan JPG atau PNG.',
                    'ext_in'   => 'Ekstensi file tidak didukung. Gunakan JPG atau PNG.',
                    'max_size' => 'Ukuran file terlalu besar. Maksimal {param} KB (≈ 3 MB).',
                ]
            ],
        ];

        // 2) Validate sekali
        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_errors', array_values($this->validator->getErrors())); // untuk Swal list error
        }

        // 3) Handle file (jika ada yang baru)
        $fotoNameLama = is_array($row) ? ($row['foto_tanaman'] ?? null) : ($row->foto_tanaman ?? null);
        $fotoNameBaru = $fotoNameLama;

        if ($hasNewFile && $file->getError() === UPLOAD_ERR_OK) {
            $targetPath = FCPATH . 'assets/uploads/tanaman';
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }
            $ext      = strtolower($file->getExtension() ?: 'jpg');
            $safeName = 'tanaman_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;

            if (! $file->move($targetPath, $safeName)) {
                return redirect()->back()->withInput()
                    ->with('sweet_errors', ['Upload gagal: ' . ($file->getErrorString() ?? 'Gagal memindahkan file.')]);
            }

            // hapus lama (jika ada)
            if (!empty($fotoNameLama)) {
                $old = $targetPath . DIRECTORY_SEPARATOR . $fotoNameLama;
                if (is_file($old)) {
                    @unlink($old);
                }
            }

            $fotoNameBaru = $safeName;
        }

        // 4) Normalisasi input
        $tglInput   = (string) $this->request->getPost('tanggal_pendataan');
        $dt         = \DateTime::createFromFormat('Y-m-d\TH:i', $tglInput, new \DateTimeZone('Asia/Jakarta'));
        $tanggalSql = $dt ? $dt->format('Y-m-d H:i:00') : null;

        $data = [
            'nama_umum'         => (string) $this->request->getPost('nama_umum'),
            'nama_latin'        => (string) $this->request->getPost('nama_latin'),
            'asal_daerah'       => (string) $this->request->getPost('asal_daerah'),
            'manfaat'           => (string) $this->request->getPost('manfaat'),
            'keterangan'        => (string) $this->request->getPost('keterangan'),
            'tanggal_pendataan' => $tanggalSql,
            'jumlah'            => (int) $this->request->getPost('jumlah'),
            'petugas_id'        => (int) $session->get('id_admin'),
            'petugas_nama'      => (string) $session->get('username'),
            'lokasi_gps_lat'    => $this->request->getPost('lokasi_gps_lat') !== '' ? (float) $this->request->getPost('lokasi_gps_lat') : null,
            'lokasi_gps_lng'    => $this->request->getPost('lokasi_gps_lng') !== '' ? (float) $this->request->getPost('lokasi_gps_lng') : null,
            'status'            => strtolower((string) $this->request->getPost('status')),
            'updated_at'        => date('Y-m-d H:i:s'),
        ];

        if ($fotoNameBaru !== $fotoNameLama) {
            $data['foto_tanaman'] = $fotoNameBaru;
        }

        // 5) Update
        try {
            $model->update($id, $data);
            return redirect()->to(route_to('admin/tanamanku'))
                ->with('sweet_success', 'Data berhasil diperbarui.');
        } catch (\Throwable $e) {
            log_message('error', 'EditTanamanku error: {msg}', ['msg' => $e->getMessage()]);
            return redirect()->back()->withInput()
                ->with('sweet_errors', ['Terjadi kesalahan, silakan coba lagi.']);
        }
    }


    public function DetailTanamanku(int $id)
    {

        // Ambil detail
        $row = $this->ModelTanamanku->find($id);
        if (!$row) {
            // throw PageNotFoundException::forPageNotFound('Data tanaman tidak ditemukan.');
            return redirect()->to(site_url('admin/tanamanku'))
                ->with('sweet_error', 'Data tidak ditemukan.');
        }

        // Ambil tanaman lainnya (kecualikan diri sendiri), limit untuk performa
        $related = $this->ModelTanamanku
            ->select('id_tanamanku,nama_umum,nama_latin,foto_tanaman')
            ->where('id_tanamanku !=', $id)
            ->orderBy('id_tanamanku', 'DESC')
            ->findAll(20);

        $data = [
            'title'      => 'TP PKK | Detail Tanaman',
            'sub_judul'  => 'Detail Tanaman',
            'row'        => $row,
            'related'    => $related,
        ];

        return view('pages/admin/detail-tanamanku', $data);
    }


    public function DeleteTanamanku($id = null)
    {
        $id    = (int) ($id ?? $this->request->getPost('id_tanamanku'));
        $model = new \App\Models\TanamankuModel();

        $row = $model->find($id);
        if (! $row) {
            return redirect()->back()->with('sweet_error', 'Data tidak ditemukan.');
        }

        // hapus file (disimpan di public/assets/uploads/tanaman)
        if (!empty($row['foto_tanaman'])) {
            $fname = basename($row['foto_tanaman']); // cegah path traversal
            $path  = FCPATH . 'assets/uploads/tanaman/' . $fname;

            if (is_file($path)) {
                @unlink($path); // hapus file, abaikan warning
            }
        }

        // hapus record
        $model->delete($id);

        return redirect()->to(site_url('admin/tanamanku'))
            ->with('sweet_success', 'Data berhasil dihapus.');
    }
}
