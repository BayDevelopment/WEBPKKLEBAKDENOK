<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        //
        $session = session();

        // Tidak login?
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(site_url('auth/login'))
                ->with('sweet_error', 'Silakan login terlebih dahulu.');
        }

        // Wajib role admin
        if (strtolower((string)$session->get('role')) !== 'admin') {
            return redirect()->to(site_url('auth/login'))
                ->with('sweet_error', 'Akses ditolak: bukan admin.');
        }

        // Idle timeout (mis. 30 menit)
        $maxIdle = 60 * 30;
        $last = (int) $session->get('lastActivity');
        if ($last && (time() - $last) > $maxIdle) {
            $session->destroy();
            return redirect()->to(site_url('auth/login'))
                ->with('sweet_error', 'Sesi berakhir, silakan login kembali.');
        }

        // Update timestamp aktivitas
        $session->set('lastActivity', time());
        return null;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
