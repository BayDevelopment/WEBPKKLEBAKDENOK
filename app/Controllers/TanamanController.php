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

        // Ambil objek file lebih dulu
        $file = $this->request->getFile('foto_tanaman');

        // Atur rules foto dinamis
        $fotoRules = 'uploaded[foto_tanaman]';
        if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            // Jika user memilih file, barulah validasi file-nya
            $fotoRules = 'uploaded[foto_tanaman]|is_image[foto_tanaman]|mime_in[foto_tanaman,image/jpg,image/jpeg,image/png]|max_size[foto_tanaman,3072]';
        }

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

            'nama_latin' => [
                'label'  => 'Nama Latin',
                'rules'  => 'permit_empty|max_length[150]',
                'errors' => [
                    'max_length' => '{field} maksimal {param} karakter.',
                ]
            ],

            'asal_daerah' => [
                'label'  => 'Asal Daerah',
                'rules'  => 'permit_empty|max_length[150]',
                'errors' => [
                    'max_length' => '{field} maksimal {param} karakter.',
                ]
            ],

            'manfaat' => [
                'label'  => 'Manfaat',
                'rules'  => 'permit_empty|max_length[2000]',
                'errors' => [
                    'max_length' => '{field} maksimal {param} karakter.',
                ]
            ],

            'keterangan' => [
                'label'  => 'Keterangan',
                'rules'  => 'permit_empty|max_length[3000]',
                'errors' => [
                    'max_length' => '{field} maksimal {param} karakter.',
                ]
            ],

            // Jika input pakai <input type="datetime-local"> (YYYY-MM-DDTHH:MM)
            'tanggal_pendataan' => [
                'label'  => 'Tanggal Pendataan',
                'rules'  => 'required|valid_date[Y-m-d\TH:i]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'valid_date' => '{field} tidak valid. Gunakan format YYYY-MM-DDTHH:MM.',
                ]
            ],
            // Jika pakai <input type="date"> ganti rules menjadi: 'required|valid_date[Y-m-d]'
            // dan ubah pesan: 'Gunakan format YYYY-MM-DD.'

            'jumlah' => [
                'label'  => 'Jumlah',
                'rules'  => 'required|is_natural_no_zero',
                'errors' => [
                    'required'           => '{field} wajib diisi.',
                    'is_natural_no_zero' => '{field} harus bilangan bulat dan minimal 1.',
                ]
            ],

            'lokasi_gps_lat' => [
                'label'  => 'Latitude',
                'rules'  => 'permit_empty|decimal',
                'errors' => [
                    'decimal' => '{field} harus berupa angka desimal. Gunakan titik (.) untuk desimal.',
                ]
            ],

            'lokasi_gps_lng' => [
                'label'  => 'Longitude',
                'rules'  => 'permit_empty|decimal',
                'errors' => [
                    'decimal' => '{field} harus berupa angka desimal. Gunakan titik (.) untuk desimal.',
                ]
            ],

            // Pastikan value di <select> adalah "active" atau "inactive" (huruf kecil)
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required|in_list[active,inactive]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid. Pilih salah satu: active atau inactive.',
                ]
            ],

            // $fotoRules dibuat dinamis sebelumnya; siapkan pesan untuk semua kemungkinan.
            'foto_tanaman' => [
                'label'  => 'Foto Tanaman',
                'rules'  => $fotoRules, // contoh: 'permit_empty' ATAU 'uploaded|is_image|mime_in|max_size'
                'errors' => [
                    'uploaded' => '{field} wajib dipilih.',
                    'is_image' => 'File yang diunggah bukan gambar yang valid.',
                    'mime_in'  => 'Format gambar tidak didukung. Gunakan JPG atau PNG.',
                    'max_size' => 'Ukuran file terlalu besar. Maksimal {param} KB (≈ 3 MB).',
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                // ->with('validation', $this->validator) // ⬅️ bawa validator ke session
                ->with('sweet_error', 'Periksa kembali isian formulir.');
        }

        // --- HANDLE FILE ---
        $fotoName = null;
        if ($file && $file->isValid() && $file->getError() === UPLOAD_ERR_OK) {
            $targetPath = FCPATH . 'assets/uploads/tanaman';
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }
            $ext      = $file->getExtension();
            $safeName = 'tanaman_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            $file->move($targetPath, $safeName);
            $fotoName = $safeName;
        }

        // --- NORMALISASI INPUT ---
        $tglInput = (string) $this->request->getPost('tanggal_pendataan'); // contoh: 2025-09-13T22:30
        $dt = \DateTime::createFromFormat('Y-m-d\TH:i', $tglInput, new \DateTimeZone('Asia/Jakarta'));
        $tanggalSql = $dt ? $dt->format('Y-m-d H:i:00') : null;

        $data = [
            'nama_umum'         => (string)$this->request->getPost('nama_umum'),
            'nama_latin'        => (string)$this->request->getPost('nama_latin'),
            'asal_daerah'       => (string)$this->request->getPost('asal_daerah'),
            'manfaat'           => (string)$this->request->getPost('manfaat'),
            'keterangan'        => (string)$this->request->getPost('keterangan'),
            'tanggal_pendataan' => $tanggalSql, // sudah ke format DATETIME
            'jumlah'            => (int)$this->request->getPost('jumlah'),
            'petugas_id'        => (int)$session->get('id_admin'),
            'petugas_nama'      => (string)$session->get('username'),
            'lokasi_gps_lat'    => $this->request->getPost('lokasi_gps_lat') !== '' ? (float)$this->request->getPost('lokasi_gps_lat') : null,
            'lokasi_gps_lng'    => $this->request->getPost('lokasi_gps_lng') !== '' ? (float)$this->request->getPost('lokasi_gps_lng') : null,
            // pastikan form kirim 'aktif'/'nonaktif' lowercase
            'status'            => strtolower((string)$this->request->getPost('status')),
        ];
        if ($fotoName) $data['foto_tanaman'] = $fotoName;

        $model = new TanamankuModel();
        try {
            $model->insert($data);
            return redirect()->to(route_to('admin/tanamanku'))
                ->with('sweet_success', 'Data berhasil ditambahkan');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()
                ->with('sweet_error', 'Terjadi kesalahan, silakan coba lagi.');
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
        $model   = new TanamankuModel();

        // --- CEK DATA LAMA ---
        $row = $model->find($id);
        if (!$row) {
            return redirect()
                ->to(route_to('admin/tanamanku')) // arahkan ke daftar Tanamanku
                ->with('sweet_error', 'Data Tanamanku tidak ditemukan atau sudah dihapus.');
        }


        // --- AMBIL FILE ---
        $file = $this->request->getFile('foto_tanaman');

        // --- RULES FOTO: opsional saat edit ---
        $fotoRules = 'permit_empty';
        if ($file && $file->isValid() && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            // hanya validasi jika user memilih file
            $fotoRules = 'is_image[foto_tanaman]|mime_in[foto_tanaman,image/jpg,image/jpeg,image/png]|max_size[foto_tanaman,3072]';
        }

        // --- RULES LAINNYA ---
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
            'nama_latin' => [
                'label'  => 'Nama Latin',
                'rules'  => 'permit_empty|max_length[150]',
                'errors' => ['max_length' => '{field} maksimal {param} karakter.']
            ],
            'asal_daerah' => [
                'label'  => 'Asal Daerah',
                'rules'  => 'permit_empty|max_length[150]',
                'errors' => ['max_length' => '{field} maksimal {param} karakter.']
            ],
            'manfaat' => [
                'label'  => 'Manfaat',
                'rules'  => 'permit_empty|max_length[2000]',
                'errors' => ['max_length' => '{field} maksimal {param} karakter.']
            ],
            'keterangan' => [
                'label'  => 'Keterangan',
                'rules'  => 'permit_empty|max_length[3000]',
                'errors' => ['max_length' => '{field} maksimal {param} karakter.']
            ],
            // Jika pakai <input type="datetime-local">
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
            'lokasi_gps_lat' => [
                'label'  => 'Latitude',
                'rules'  => 'permit_empty|decimal',
                'errors' => ['decimal' => '{field} harus berupa angka desimal. Gunakan titik (.) untuk desimal.']
            ],
            'lokasi_gps_lng' => [
                'label'  => 'Longitude',
                'rules'  => 'permit_empty|decimal',
                'errors' => ['decimal' => '{field} harus berupa angka desimal. Gunakan titik (.) untuk desimal.']
            ],
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
                    'uploaded' => '{field} wajib dipilih.',
                    'is_image' => 'File yang diunggah bukan gambar yang valid.',
                    'mime_in'  => 'Format gambar tidak didukung. Gunakan JPG atau PNG.',
                    'max_size' => 'Ukuran file terlalu besar. Maksimal {param} KB (≈ 3 MB).',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_error', 'Periksa kembali isian formulir.');
        }

        // --- HANDLE FILE (ganti + hapus lama bila ada) ---
        $fotoNameLama = $row['foto_tanaman'] ?? ($row->foto_tanaman ?? null);
        $fotoNameBaru = $fotoNameLama;

        if ($file && $file->isValid() && $file->getError() === UPLOAD_ERR_OK) {
            $targetPath = FCPATH . 'assets/uploads/tanaman';
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }
            $ext      = $file->getExtension();
            $safeName = 'tanaman_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            $file->move($targetPath, $safeName);

            // Hapus file lama jika ada
            if (!empty($fotoNameLama)) {
                $old = $targetPath . '/' . $fotoNameLama;
                if (is_file($old)) @unlink($old);
            }

            $fotoNameBaru = $safeName;
        }

        // --- NORMALISASI INPUT ---
        $tglInput   = (string) $this->request->getPost('tanggal_pendataan'); // 2025-09-13T22:30
        $dt         = \DateTime::createFromFormat('Y-m-d\TH:i', $tglInput, new \DateTimeZone('Asia/Jakarta'));
        $tanggalSql = $dt ? $dt->format('Y-m-d H:i:00') : null;

        $data = [
            'nama_umum'         => (string)$this->request->getPost('nama_umum'),
            'nama_latin'        => (string)$this->request->getPost('nama_latin'),
            'asal_daerah'       => (string)$this->request->getPost('asal_daerah'),
            'manfaat'           => (string)$this->request->getPost('manfaat'),
            'keterangan'        => (string)$this->request->getPost('keterangan'),
            'tanggal_pendataan' => $tanggalSql,
            'jumlah'            => (int)$this->request->getPost('jumlah'),
            'petugas_id'        => (int)$session->get('id_admin'),
            'petugas_nama'      => (string)$session->get('username'),
            'lokasi_gps_lat'    => $this->request->getPost('lokasi_gps_lat') !== '' ? (float)$this->request->getPost('lokasi_gps_lat') : null,
            'lokasi_gps_lng'    => $this->request->getPost('lokasi_gps_lng') !== '' ? (float)$this->request->getPost('lokasi_gps_lng') : null,
            'status'            => strtolower((string)$this->request->getPost('status')),
            // Jika model Anda pakai timestamp otomatis, baris ini bisa di-skip
            'updated_at'        => date('Y-m-d H:i:s'),
        ];

        // set foto baru jika berubah
        if ($fotoNameBaru !== $fotoNameLama) {
            $data['foto_tanaman'] = $fotoNameBaru;
        }

        try {
            $model->update($id, $data);
            return redirect()->to(route_to('admin/tanamanku'))
                ->with('sweet_success', 'Data berhasil diperbarui');
        } catch (\Throwable $e) {
            log_message('error', 'EditTanamanku error: {msg}', ['msg' => $e->getMessage()]);
            return redirect()->back()->withInput()
                ->with('sweet_error', 'Terjadi kesalahan, silakan coba lagi.');
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
