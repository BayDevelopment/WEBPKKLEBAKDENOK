<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    protected $AdminModel;
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
    }
    public function page_profile()
    {
        // ambil id admin dari session
        $id_admin = session()->get('id_admin'); // sesuaikan nama key session kamu

        // query data admin sesuai id session
        $admin = $this->AdminModel->where('id_admin', $id_admin)->first();
        if (!$admin) {
            return redirect()->to(site_url('admin/profile'))
                ->with('sweet_error', 'Data tidak ditemukan.');
        }
        $data = [
            'title'      => 'TP PKK | Profile',
            'sub_judul' =>  'Profile',
            'subLink'    => 'Profile',
            'd_admin'    => $admin,
        ];

        return view('pages/admin/profile', $data);
    }
    public function edit_profile()
    {
        $id = session()->get('id_admin');
        if (!$id) return redirect()->to(site_url('auth/login'))->with('error', 'Silakan login');

        $admin = $this->AdminModel->where('id_admin', $id)->first();

        $data = [
            'title'   => 'TP PKK | Edit Profile',
            'sub_judul' => 'profile',
            'subLink' => 'Profile',
            'd_admin' => $admin,
        ];

        return view('pages/admin/edit-profile', $data);
    }

    public function aksi_update_profile()
    {
        $id = session('id_admin');
        if (!$id) {
            return redirect()->to(site_url('auth/logout'))->with('sweet_error', 'Silakan login');
        }

        // ===== VALIDASI =====
        $rules = [
            'username'       => "required|min_length[3]|max_length[50]|is_unique[tb_admin.username,id_admin,{$id}]",
            'email'          => "required|valid_email|max_length[100]|is_unique[tb_admin.email,id_admin,{$id}]",
            'jenis_kelamin'  => 'required|in_list[L,P]',
            'status_account' => 'required|in_list[active,inactive]',
            // opsional (di-unset jika tidak upload)
            'img_admin'      => 'uploaded[img_admin]|is_image[img_admin]|max_size[img_admin,2048]|mime_in[img_admin,image/jpg,image/jpeg,image/png]',
        ];
        if (empty($_FILES['img_admin']['name'])) unset($rules['img_admin']);

        if (!$this->validate($rules)) {
            $errs = $this->validator->getErrors();
            return redirect()->back()
                ->withInput()
                ->with('errors', $errs)                                 // untuk validation_show_error()
                ->with('sweet_error', implode('<br>', array_values($errs))); // untuk SweetAlert (opsional)
        }

        // ===== SIAPKAN DATA =====
        $data = [
            'username'       => $this->request->getPost('username'),
            'email'          => $this->request->getPost('email'),
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'), // 'L' / 'P'
            'status_account' => $this->request->getPost('status_account'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        // ===== UPLOAD FOTO (opsional) =====
        $file = $this->request->getFile('img_admin');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $dir  = FCPATH . 'assets/uploads/avatars';
            is_dir($dir) || mkdir($dir, 0775, true);

            $new = time() . '_' . preg_replace('/\s+/', '_', $file->getClientName());
            if ($file->move($dir, $new)) {
                // Hapus foto lama (ambil dari DB; aman untuk returnType array/object)
                $before  = $this->AdminModel->select('img_admin')->find($id);
                $oldName = is_array($before) ? ($before['img_admin'] ?? null) : ($before->img_admin ?? null);
                if ($oldName && is_file($dir . '/' . $oldName)) @unlink($dir . '/' . $oldName);

                $data['img_admin'] = $new;
            }
        }

        // ===== SIMPAN =====
        $this->AdminModel->update($id, $data);

        // Sinkronkan session (kalau dipakai di header/topbar)
        session()->set([
            'username'  => $data['username'],
            'email'     => $data['email'],
            'img_admin' => $data['img_admin'] ?? session('img_admin'),
        ]);

        return redirect()->to(site_url('admin/profile'))
            ->with('sweet_success', 'Profil berhasil diperbarui.');
    }

    // reset password 
    // di Controller Admin.php (sesuaikan nama kelasmu)
    public function change_password()
    {
        $id = session('id_admin');
        if (!$id) {
            return redirect()->to(site_url('auth/logout'))->with('sweet_error', 'Silakan login');
        }

        // opsional: kalau view perlu data admin (untuk header/avatar)
        $d_admin = $this->AdminModel->find($id);

        return view('pages/admin/ganti-password', [
            'title'    => 'Ganti Password',
            'sub_judul' => 'Profile',
            'subLink'  => 'Profile',
            'd_admin'  => $d_admin,
        ]);
    }

    public function update_password()
    {
        $id = session('id_admin');
        if (!$id) {
            return redirect()->to(site_url('auth/logout'))->with('sweet_error', 'Silakan login');
        }

        // Rules: current_password (wajib), password_hash = password baru, confirm_password = konfirmasi
        $rules = [
            'current_password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password saat ini wajib diisi.',
                ],
            ],
            'password_hash' => [ // <-- password BARU (diganti dari new_password)
                'rules'  => 'required|min_length[8]|max_length[72]|regex_match[/(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^a-zA-Z0-9]).+/]',
                'errors' => [
                    'required'    => 'Password baru wajib diisi.',
                    'min_length'  => 'Password baru minimal {param} karakter.',
                    'max_length'  => 'Password baru maksimal {param} karakter.',
                    'regex_match' => 'Password baru harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
                ],
            ],
            'new_password_confirm' => [ // <-- konfirmasi
                'rules'  => 'required|matches[password_hash]',
                'errors' => [
                    'required' => 'Konfirmasi password wajib diisi.',
                    'matches'  => 'Konfirmasi password harus sama dengan password baru.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $errs = $this->validator->getErrors();
            return redirect()->back()
                ->withInput()
                ->with('errors', $errs)
                ->with('sweet_error', implode('<br>', array_map('esc', array_values($errs))));
        }

        // Ambil hash lama dari DB
        $row  = $this->AdminModel->select('password_hash')->find($id);
        $hash = is_array($row) ? ($row['password_hash'] ?? '') : ($row->password_hash ?? '');

        // Ambil input
        $cur = (string) $this->request->getPost('current_password'); // password saat ini
        $new = (string) $this->request->getPost('password_hash');    // password baru

        // Verifikasi password saat ini
        if (!password_verify($cur, $hash)) {
            return redirect()->back()->withInput()
                ->with('errors', ['current_password' => 'Password saat ini salah.'])
                ->with('sweet_error', 'Password saat ini salah.');
        }

        // Larang password baru sama dengan lama
        if (password_verify($new, $hash)) {
            return redirect()->back()->withInput()
                ->with('errors', ['password_hash' => 'Password baru tidak boleh sama dengan password lama.'])
                ->with('sweet_error', 'Password baru tidak boleh sama dengan password lama.');
        }

        // Hash Argon2id
        $newHash = password_hash($new, PASSWORD_ARGON2ID);

        // Simpan
        $ok = $this->AdminModel->update($id, [
            'password_hash' => $newHash,
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        if (!$ok) {
            return redirect()->back()->withInput()
                ->with('sweet_error', 'Gagal memperbarui password. Coba lagi.');
        }

        // Amankan sesi
        session()->regenerate();

        return redirect()->to(site_url('admin/profile/ganti-password'))
            ->with('sweet_success', 'Password berhasil diperbarui.');
    }
}
