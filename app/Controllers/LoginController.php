<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    protected $AdminModel;

    public function __construct()
    {
        $this->AdminModel = new AdminModel();
    }
    public function index()
    {
        //
        $data = [
            'title' => 'PKK | Login',
        ];
        return view('/pages/index', $data);
    }
    public function aksi_login()
    {
        $request = $this->request;
        $session = session();

        // --- Rate limit sederhana: 5 percobaan / 10 menit per IP+username ---
        // --- Rate limit sederhana: 5 percobaan / 10 menit per IP+username ---
        $ip        = $request->getIPAddress();
        $username  = $request->getPost('username');
        $password  = $request->getPost('password_hash');

        $rlKey     = 'login_' . md5(strtolower($username) . '|' . $ip); // ✅ aman
        $attempts  = cache($rlKey) ?? 0;

        if ($attempts >= 5) {
            return redirect()->back()
                ->with('sweet_error', 'Terlalu banyak percobaan. Coba lagi dalam beberapa menit.')
                ->withInput();
        }

        // Validasi dasar
        if ($username === '' || $password === '') {
            return redirect()->back()
                ->with('sweet_error', 'Username dan Password wajib diisi')
                ->withInput();
        }
        if (mb_strlen($password) < 6) {
            return redirect()->back()
                ->with('sweet_error', 'Password minimal 6 karakter')
                ->withInput();
        }

        // Cari user
        $user = $this->AdminModel->where('username', $username)->first();

        // Verifikasi kredensial (jaga pesan error tetap generik)
        if (!$user || !password_verify($password, (string)$user['password_hash'])) {
            cache()->save($rlKey, $attempts + 1, 600); // 10 menit
            usleep(200000); // 200ms, kecilkan timing leak
            return redirect()->back()
                ->with('sweet_error', 'Username atau Password salah')
                ->withInput();
        }

        // Normalisasi nilai
        $role   = strtolower((string)($user['role'] ?? ''));
        $status = strtolower((string)($user['status_account'] ?? ''));

        // Cek status aktif
        if ($status !== 'active') {
            return redirect()->back()
                ->with('sweet_error', 'Akun Anda tidak aktif')
                ->withInput();
        }

        // Cek hanya admin
        if ($role !== 'admin') {
            return redirect()->back()
                ->with('sweet_error', 'Akses ditolak: khusus admin')
                ->withInput();
        }

        // Lulus semua: reset rate limit
        cache()->delete($rlKey);

        // Regenerate session untuk cegah session fixation
        $session->regenerate(true);

        // Set data sesi minimal & perlu
        $session->set([
            'isLoggedIn'     => true,
            'id_admin'       => (int)$user['id_admin'],
            'img_admin'      => (string)($user['img_admin'] ?? ''),
            'username'       => (string)$user['username'],
            'email'          => (string)$user['email'],
            'jenis_kelamin'  => (string)($user['jenis_kelamin'] ?? ''),
            'role'           => $role,
            'status_account' => $status,
            'lastActivity'   => time(),
        ]);

        return redirect()->to(site_url('admin/dashboard'))
            ->with('sweet_success', 'Login berhasil');
    }



    public function logout()
    {
        // Simpan flashdata dalam cookie sebelum session dihancurkan
        setcookie("flash_logout", "Selamat, berhasil logout!", time() + 3, "/");

        // Hapus seluruh session
        session()->destroy();

        return redirect()->to('/auth/login');
    }
}
