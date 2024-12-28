<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->get('logged_in')){
            session()->setFlashdata('pesan', 'Anda Belum Login');
            return redirect()->to('/user');
        }

        if(session()->get('role') != 'admin'){
            session()->setFlashdata('pesan', 'Mohon maaf, Anda tidak memiliki akses!');
            return redirect()->to('/user');
            
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}