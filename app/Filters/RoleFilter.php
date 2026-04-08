<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ambil role dari session
        $userRole = session()->get('role');

        // Jika tidak ada argument role yang diizinkan, lewati
        if (empty($arguments)) {
            return;
        }

        // Cek apakah role user termasuk dalam daftar yang diizinkan
        if (!in_array($userRole, $arguments)) {
            // Redirect ke dashboard sesuai role user
            switch ($userRole) {
                case 'admin':
                    return redirect()->to('/admin/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
                case 'ustadz':
                    return redirect()->to('/ustadz/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
                case 'ortu':
                    return redirect()->to('/ortu/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
                default:
                    return redirect()->to('/auth/login');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu aksi setelah request
    }
}
