<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = session()->get('role');

        // Periksa apakah user memiliki role yang valid
        if (!in_array($role, $arguments)) {
            session()->setFlashdata('pesan', 'Anda tidak memiliki akses ke halaman tersebut!');
            return redirect()->to('/'); // Redirect ke halaman utama
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}
