<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\PkkPokja;
use App\Models\ModelPkk;
use App\Models\RekrutModel;
use CodeIgniter\HTTP\ResponseInterface;

class RekrutController extends BaseController
{
    protected $pkkPokjaModel;
    public function __construct()
    {
        $this->pkkPokjaModel = new ModelPkk();
    }
    public function page_insert()
    {
        $data = [
            'title' => 'TP PKK | Tambah Rekrutmen',
            'sub_judul' => 'Tambah Rekrutmen',
            'd_pkkpokja'  => $this->pkkPokjaModel->select('id_pkkpokja,kode,nama')
                ->where('aktif', 1)
                ->orderBy('kode', 'ASC')
                ->findAll(),
            'validation'  => \Config\Services::validation()
        ];
        return view('pages/admin/tambah-rekrutmen', $data);
    }

    public function aksi_insert_rekrutmen()
    {
        // 0) Guard khusus NIK berisi teks (sebelum validasi CI)
        $rawNik = (string) $this->request->getPost('nik');
        if ($rawNik !== '' && preg_match('/\D/', $rawNik)) {
            return redirect()->back()->withInput()
                ->with('sweet_error', 'NIK hanya boleh berisi angka (0–9).');
        }

        // 1) Rules utama (tetap pakai numeric & exact_length sebagai sabuk pengaman)
        $rules = [
            'id_pkkpokja' => [
                'rules'  => 'required|is_not_unique[tb_pkk_pokja.id_pkkpokja]',
                'errors' => [
                    'required'      => 'Pokja wajib dipilih.',
                    'is_not_unique' => 'Pokja tidak valid.',
                ],
            ],
            'nama_lengkap' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama wajib diisi.',
                    'min_length' => 'Nama minimal 3 karakter.',
                    'max_length' => 'Nama maksimal 100 karakter.',
                ],
            ],
            'nik' => [
                'rules'  => 'required|exact_length[16]|numeric|is_unique[tb_pkk_pendaftaran.nik]',
                'errors' => [
                    'required'     => 'NIK wajib diisi.',
                    'exact_length' => 'NIK harus 16 digit.',
                    'numeric'      => 'NIK harus angka.',
                    'is_unique'    => 'NIK sudah terdaftar.',
                ],
            ],
            'alamat' => [
                'rules'  => 'required|min_length[5]|max_length[200]',
                'errors' => [
                    'required'   => 'Alamat wajib diisi.',
                    'min_length' => 'Alamat terlalu pendek.',
                    'max_length' => 'Alamat terlalu panjang.',
                ],
            ],
            'no_hp' => [
                'rules'  => 'permit_empty|min_length[9]|max_length[20]',
                'errors' => [
                    'min_length' => 'No HP terlalu pendek.',
                    'max_length' => 'No HP terlalu panjang.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            // Ambil satu pesan error paling awal untuk SweetAlert
            $errors = $this->validator->getErrors();
            $firstError = array_values($errors)[0] ?? 'Periksa kembali input Anda.';
            return redirect()->back()->withInput()
                ->with('validation', $this->validator)
                ->with('sweet_error', $firstError);
        }

        // 2) Payload bersih
        $nik = preg_replace('/\D/', '', $rawNik); // keep digits untuk konsistensi

        $payload = [
            'id_pkkpokja'  => (int) $this->request->getPost('id_pkkpokja'),
            'nama_lengkap' => trim((string) $this->request->getPost('nama_lengkap')),
            'nik'          => $nik,
            'alamat'       => trim((string) $this->request->getPost('alamat')),
            'no_hp'        => trim((string) $this->request->getPost('no_hp')) ?: null,
        ];

        $pendaftaran = new \App\Models\RekrutModel();
        $pokja       = new \App\Models\ModelPkk();

        // 3) Double-check FK biar message ramah
        if (! $pokja->where('id_pkkpokja', $payload['id_pkkpokja'])->first()) {
            return redirect()->back()->withInput()
                ->with('sweet_error', 'Pokja tidak ditemukan.');
        }

        // 4) Insert
        $pendaftaran->insert($payload);

        return redirect()->to(site_url('admin/rekrutmen'))
            ->with('sweet_success', 'Pendaftaran berhasil dikirim.');
    }

    // Tampilkan halaman edit
    public function page_edit_rekrutmen($id = null)
    {
        $id = (int) $id;
        if ($id <= 0) {
            return redirect()->to(site_url('admin/rekrutmen'))->with('sweet_error', 'Permintaan tidak valid.');
        }

        $mRekrut = new \App\Models\RekrutModel();
        $row = $mRekrut->find($id);
        if (! $row) {
            return redirect()->to(site_url('admin/rekrutmen'))->with('sweet_error', 'Data tidak ditemukan.');
        }

        $data = [
            'title'       => 'TP PKK | Edit Rekrutmen',
            'sub_judul'   => 'Edit Rekrutmen',
            'rekrut'      => $row,
            'd_pkkpokja'  => $this->pkkPokjaModel
                ->select('id_pkkpokja,kode,nama')
                ->where('aktif', 1)
                ->orderBy('kode', 'ASC')
                ->findAll(),
            'validation'  => \Config\Services::validation(),
        ];
        return view('pages/admin/edit-rekrutmen', $data);
    }

    // Aksi simpan edit
    public function aksi_edit_rekrutmen($id = null)
    {
        $id = (int) ($id ?: $this->request->getPost('id_pendaftaran'));
        if ($id <= 0) {
            return redirect()->back()->with('sweet_error', 'Permintaan tidak valid.');
        }

        $mRekrut = new \App\Models\RekrutModel();
        $row = $mRekrut->find($id);
        if (! $row) {
            return redirect()->to(site_url('admin/rekrutmen'))->with('sweet_error', 'Data tidak ditemukan.');
        }

        // Guard: NIK wajib angka
        $rawNik = (string) $this->request->getPost('nik');
        if ($rawNik !== '' && preg_match('/\D/', $rawNik)) {
            return redirect()->back()->withInput()->with('sweet_error', 'NIK hanya boleh berisi angka (0–9).');
        }

        // Rules: unique NIK kecuali dirinya sendiri
        $rules = [
            'id_pkkpokja' => [
                'rules'  => 'required|is_not_unique[tb_pkk_pokja.id_pkkpokja]',
                'errors' => [
                    'required'      => 'Pokja wajib dipilih.',
                    'is_not_unique' => 'Pokja tidak valid.',
                ],
            ],
            'nama_lengkap' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama wajib diisi.',
                    'min_length' => 'Nama minimal 3 karakter.',
                    'max_length' => 'Nama maksimal 100 karakter.',
                ],
            ],
            'nik' => [
                'rules'  => "required|exact_length[16]|numeric|is_unique[tb_pkk_pendaftaran.nik,id_pendaftaran,{$id}]",
                'errors' => [
                    'required'     => 'NIK wajib diisi.',
                    'exact_length' => 'NIK harus 16 digit.',
                    'numeric'      => 'NIK harus angka.',
                    'is_unique'    => 'NIK sudah terdaftar.',
                ],
            ],
            'alamat' => [
                'rules'  => 'required|min_length[5]|max_length[200]',
                'errors' => [
                    'required'   => 'Alamat wajib diisi.',
                    'min_length' => 'Alamat terlalu pendek.',
                    'max_length' => 'Alamat terlalu panjang.',
                ],
            ],
            'no_hp' => [
                'rules'  => 'permit_empty|min_length[9]|max_length[20]',
                'errors' => [
                    'min_length' => 'No HP terlalu pendek.',
                    'max_length' => 'No HP terlalu panjang.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            $firstError = array_values($this->validator->getErrors())[0] ?? 'Periksa kembali input Anda.';
            return redirect()->back()->withInput()
                ->with('validation', $this->validator)
                ->with('sweet_error', $firstError);
        }

        // Payload bersih
        $nik = preg_replace('/\D/', '', $rawNik);
        $payload = [
            'id_pkkpokja'  => (int) $this->request->getPost('id_pkkpokja'),
            'nama_lengkap' => trim((string) $this->request->getPost('nama_lengkap')),
            'nik'          => $nik,
            'alamat'       => trim((string) $this->request->getPost('alamat')),
            'no_hp'        => trim((string) $this->request->getPost('no_hp')) ?: null,
        ];

        // Double-check FK (opsional, biar pesan ramah)
        $pokja = new \App\Models\ModelPkk();
        if (! $pokja->find($payload['id_pkkpokja'])) {
            return redirect()->back()->withInput()->with('sweet_error', 'Pokja tidak ditemukan.');
        }

        try {
            $mRekrut->update($id, $payload);
        } catch (\Throwable $e) {
            // Misal ada constraint unik lain di DB
            return redirect()->back()->withInput()
                ->with('sweet_error', 'Gagal menyimpan perubahan.');
        }

        return redirect()->to(site_url('admin/rekrutmen'))
            ->with('sweet_success', 'Pendaftaran berhasil diperbarui.');
    }

    public function page_detail_rekrutmen($id = null)
    {
        $id = (int) $id;
        if ($id <= 0) {
            return redirect()->to(site_url('admin/rekrutmen'))
                ->with('sweet_error', 'Permintaan tidak valid.');
        }

        $rekrut = (new RekrutModel())
            ->select('tb_pkk_pendaftaran.*, tb_pkk_pokja.kode AS pokja_kode, tb_pkk_pokja.nama AS pokja_nama')
            ->join('tb_pkk_pokja', 'tb_pkk_pokja.id_pkkpokja = tb_pkk_pendaftaran.id_pkkpokja', 'left')
            ->where('tb_pkk_pendaftaran.id_pendaftaran', $id)
            ->first();

        if (! $rekrut) {
            return redirect()->to(site_url('admin/rekrutmen'))
                ->with('sweet_error', 'Data tidak ditemukan.');
        }

        $data = [
            'title'      => 'TP PKK | Detail Rekrutmen',
            'sub_judul'  => 'Detail Rekrutmen',
            'rekrut'     => $rekrut,
            // optional, kalau view mau pakai array $pokja:
            // 'pokja'   => ['kode' => $rekrut['pokja_kode'], 'nama' => $rekrut['pokja_nama']],
            'validation' => \Config\Services::validation(),
        ];

        return view('pages/admin/detail-rekrutmen', $data);
    }

    // table delete
    public function delete_by_id($id = null)
    {
        $id = (int) $id;
        if ($id <= 0) {
            return redirect()->back()->with('sweet_error', 'ID tidak valid.');
        }

        $m = new \App\Models\RekrutModel();
        $row = $m->find($id);
        if (! $row) {
            return redirect()->back()->with('sweet_error', 'Data tidak ditemukan.');
        }

        try {
            $m->delete($id);
        } catch (\Throwable $e) {
            return redirect()->back()->with('sweet_error', 'Gagal menghapus data.');
        }

        return redirect()->back()->with('sweet_success', 'Data berhasil dihapus.');
    }

    // detail delete
    public function aksi_delete_rekrutmen($id = null)
    {
        // // Wajib POST (sesuai tombol hapus + SweetAlert di view)
        // if ($this->request->getMethod() !== 'post') {
        //     return redirect()->back()->with('sweet_error', 'Metode tidak diizinkan.');
        // }

        $id = (int) ($id ?: $this->request->getPost('id_pendaftaran'));
        if ($id <= 0) {
            return redirect()->back()->with('sweet_error', 'ID tidak valid.');
        }

        $m = new RekrutModel();
        $row = $m->find($id);
        if (! $row) {
            return redirect()->to(site_url('admin/rekrutmen'))->with('sweet_error', 'Data tidak ditemukan.');
        }

        // Hapus file pas_foto (jika kamu menyimpan path relatif di kolom 'pas_foto')
        if (!empty($row['pas_foto'])) {
            // pastikan path relatif (hindari traversal)
            $rel  = ltrim((string) $row['pas_foto'], '/\\');
            $path = FCPATH . $rel;        // contoh: public/ + assets/uploads/pas_foto/xxx.jpg
            if (is_file($path)) {
                @unlink($path);
            }
        }

        try {
            $m->delete($id); // hard/soft delete sesuai setting model
        } catch (\Throwable $e) {
            return redirect()->back()->with('sweet_error', 'Gagal menghapus data.');
        }

        return redirect()->to(site_url('admin/rekrutmen'))
            ->with('sweet_success', 'Pendaftaran berhasil dihapus.');
    }


    public function page_insert_pokja()
    {
        // Ambil semua kode dari DB via Model
        $codes = $this->pkkPokjaModel->findColumn('kode') ?? [];

        // Parse jadi angka: POKJA(\d+)
        $present = [];
        foreach ($codes as $k) {
            if (preg_match('/^POKJA(\d+)$/i', $k, $m)) {
                $present[(int) $m[1]] = true;
            }
        }

        // Cari max dan celah yang hilang 1..max
        $max = empty($present) ? 0 : max(array_keys($present));
        $missing = [];
        for ($i = 1; $i <= $max; $i++) {
            if (!isset($present[$i])) $missing[] = $i;
        }

        // Kode otomatis: ambil celah pertama jika ada, else max+1 (mulai 1)
        $autoNum   = !empty($missing) ? $missing[0] : ($max + 1);
        $auto_kode = 'POKJA' . ($autoNum ?: 1);

        $data = [
            'title'        => 'TP PKK | Tambah Pokja',
            'sub_judul'    => 'Tambah Pokja',
            'd_pkkpokja'   => $this->pkkPokjaModel->findAll(),
            'auto_kode'    => $auto_kode,     // untuk value="" di input
            'pokja_missing' => $missing,        // untuk SweetAlert di view
            'validation' => \Config\Services::validation()

        ];

        return view('pages/admin/tambah_pokja', $data);
    }
    public function aksi_insert_pokja()
    {
        // --- Normalisasi input lebih dulu (supaya is_unique cek nilai final) ---
        $post = $this->request->getPost();
        $post['kode'] = strtoupper(trim((string)($post['kode'] ?? '')));
        $post['nama'] = trim((string)($post['nama'] ?? ''));
        $post['deskripsi'] = trim((string)($post['deskripsi'] ?? ''));
        $post['aktif'] = (string)($post['aktif'] ?? '0');
        // suntik balik ke request, sehingga validator pakai nilai yang sudah dinormalisasi
        $this->request->setGlobal('post', $post);

        // --- Rules: unik global (tanpa soft delete) ---
        $rules = [
            'kode' => [
                'rules'  => 'required|regex_match[/^POKJA\d+$/i]|max_length[16]|is_unique[tb_pkk_pokja.kode]',
                'errors' => [
                    'required'    => 'Kode wajib diisi.',
                    'regex_match' => 'Format harus POKJA{angka}, contoh: POKJA2.',
                    'max_length'  => 'Kode maksimal 16 karakter.',
                    'is_unique'   => 'Kode sudah digunakan.',
                ],
            ],
            'nama' => [
                'rules'  => 'required|min_length[3]|max_length[50]|is_unique[tb_pkk_pokja.nama]',
                'errors' => [
                    'required'   => 'Nama Pokja wajib diisi.',
                    'min_length' => 'Nama minimal 3 karakter.',
                    'max_length' => 'Nama maksimal 50 karakter.',
                    'is_unique'  => 'Nama Pokja sudah digunakan.',
                ],
            ],
            'deskripsi' => [
                'rules'  => 'permit_empty|max_length[200]',
                'errors' => ['max_length' => 'Deskripsi maksimal 200 karakter.'],
            ],
            'aktif' => [
                'rules'  => 'permit_empty|in_list[0,1]',
                'errors' => ['in_list' => 'Status tidak valid. Gunakan 1 (Aktif) atau 0 (Nonaktif).'],
            ],
        ];

        if (! $this->validate($rules)) {
            $first = array_values($this->validator->getErrors())[0] ?? 'Periksa kembali isian form.';
            return redirect()->back()->withInput()
                ->with('validation', $this->validator)
                ->with('sweet_error', $first);
        }

        // --- Aturan first-gap (opsional) ---
        $expected = $this->nextKodeFirstGap();
        if ($post['kode'] !== $expected) {
            $v = service('validation');
            $v->setError('kode', "Urutan tidak berurutan. Gunakan {$expected} terlebih dahulu.");
            return redirect()->back()->withInput()
                ->with('validation', $v)
                ->with('sweet_error', "Urutan tidak berurutan. Gunakan {$expected} terlebih dahulu.");
        }

        // --- Simpan ---
        $data = [
            'kode'      => $post['kode'],
            'nama'      => $post['nama'],
            'deskripsi' => $post['deskripsi'] !== '' ? $post['deskripsi'] : null,
            'aktif'     => ($post['aktif'] === '1') ? 1 : 0,
        ];

        try {
            $this->pkkPokjaModel->insert($data);
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            // fallback kalau ada UNIQUE di DB (misal #1062) yang menolak
            return redirect()->back()->withInput()
                ->with('sweet_error', 'Gagal menyimpan: kode atau nama sudah digunakan.');
        }

        return redirect()->to(site_url('admin/rekrutmen'))
            ->with('sweet_success', 'Data Pokja berhasil disimpan.');
    }


    private function nextKodeFirstGap(): string
    {
        $codes = $this->pkkPokjaModel->findColumn('kode') ?? [];
        $taken = [];
        foreach ($codes as $k) {
            if (preg_match('/^POKJA(\d+)$/i', $k, $m)) $taken[(int)$m[1]] = true;
        }
        $i = 1;
        while (isset($taken[$i])) $i++;
        return 'POKJA' . $i;
    }

    public function page_update_pokja($id)
    {
        $dataPokjaById = $this->pkkPokjaModel->find($id);
        if (!$dataPokjaById) {
            return redirect()->to(site_url('admin/rekrutmen'))
                ->with('sweet_error', 'Data tidak ditemukan.');
        }
        $data = [
            'title'        => 'TP PKK | Edit Pokja',
            'sub_judul'    => 'Edit Pokja',
            'd_pokja'   => $dataPokjaById,
            'validation' => \Config\Services::validation()
        ];

        return view('pages/admin/edit-pokja', $data);
    }
    public function aksi_edit_pokja($id = null)
    {
        // Ambil id dari route atau hidden input
        $id = (int) ($id ?: $this->request->getPost('id_pkkpokja'));
        if ($id <= 0) {
            return redirect()->back()->with('sweet_error', 'Permintaan tidak valid.');
        }

        // Cek data existing
        $pokja = $this->pkkPokjaModel->find($id);
        if (! $pokja) {
            return redirect()->to(site_url('admin/rekrutmen'))
                ->with('sweet_error', 'Data tidak ditemukan.');
        }

        // Normalisasi input
        $nama      = trim((string) $this->request->getPost('nama'));
        $deskripsi = trim((string) ($this->request->getPost('deskripsi') ?? ''));
        $aktif     = ((string) $this->request->getPost('aktif') === '1') ? 1 : 0;

        // Rules: nama unik global kecuali dirinya; aktif wajib 0/1; deskripsi opsional (max 200)
        $rules = [
            'nama' => [
                'rules'  => "required|min_length[3]|max_length[50]|is_unique[tb_pkk_pokja.nama,id_pkkpokja,{$id}]",
                'errors' => [
                    'required'   => 'Nama Pokja wajib diisi.',
                    'min_length' => 'Nama minimal 3 karakter.',
                    'max_length' => 'Nama maksimal 50 karakter.',
                    'is_unique'  => 'Nama Pokja sudah digunakan.',
                ],
            ],
            'aktif' => [
                'rules'  => 'required|in_list[0,1]',
                'errors' => [
                    'required' => 'Status wajib diisi.',
                    'in_list'  => 'Status tidak valid.',
                ],
            ],
            'deskripsi' => [
                'rules'  => 'permit_empty|max_length[200]',
                'errors' => [
                    'max_length' => 'Deskripsi maksimal 200 karakter.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            $firstError = array_values($this->validator->getErrors())[0] ?? 'Periksa kembali input Anda.';
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->validator)
                ->with('sweet_error', $firstError);
        }

        // Siapkan payload (kode TETAP dari DB)
        $payload = [
            'kode'      => $pokja['kode'],                 // tidak diubah
            'nama'      => $nama,
            'deskripsi' => ($deskripsi !== '') ? $deskripsi : null,
            'aktif'     => $aktif,
        ];

        try {
            $this->pkkPokjaModel->update($id, $payload);
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            // Misal unique constraint (#1062)
            return redirect()->back()
                ->withInput()
                ->with('sweet_error', 'Gagal menyimpan perubahan: nama sudah digunakan.');
        }

        return redirect()->to(site_url('admin/rekrutmen'))
            ->with('sweet_success', 'Pokja berhasil diperbarui.');
    }



    public function aksi_delete_pokja($id = null)
    {
        $id = (int) $id;
        if ($id <= 0) {
            return redirect()->back()->with('sweet_error', 'ID tidak valid.');
        }

        $row = $this->pkkPokjaModel->find($id);
        if (! $row) {
            return redirect()->to(site_url('admin/rekrutmen'))
                ->with('sweet_error', 'Data tidak ditemukan.');
        }

        try {
            // soft delete (ModelPkk pakai useSoftDeletes = true)
            $this->pkkPokjaModel->delete($id);
        } catch (\Throwable $e) {
            return redirect()->to(site_url('admin/rekrutmen'))
                ->with('sweet_error', 'Gagal menghapus.');
        }

        return redirect()->to(site_url('admin/rekrutmen'))
            ->with('sweet_success', 'Pokja berhasil dihapus.');
    }
}
